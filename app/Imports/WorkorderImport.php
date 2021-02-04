<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Cache;

use App\Models\Draft;
use App\Models\DraftHasEngineer;
use App\Models\DraftHasTenant;
use App\Models\ImportHistory;

use Ramsey\Uuid\Uuid;

use Illuminate\Contracts\Queue\ShouldQueue; 
use Maatwebsite\Excel\Concerns\WithChunkReading; 

class WorkorderImport implements ToCollection, WithStartRow, WithChunkReading, ShouldQueue
{
    protected $file;
    protected $userid;

    public function  __construct($file,$userid)
    {
        $this->file = $file;
        $this->userid = $userid;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        Log::info("importing...");
        $error_company_id=0;
        $error_partner_id=0;
        $error_tenant_id=0;
        $error_area_id=0;
        $error_engineer_id=0;
        $error_plan_type_id=0;
        $error_site_id=0;
        $error_product_code=0;

        $row_number=0;
        
        $total_row_success=0;
        $total_row_fail=0;
        $total_row_ipa=0;
        $total_row_hup=0;
        $isFail=false;

        $batch_id =  $this->generateKey();

        $importHistory = ImportHistory::create([
            "user_id" => $this->userid,
            "batch_id" => $batch_id,
        ]);


        foreach ($collection as $row) 
        {
            $uuid = Uuid::uuid4();

            $company_id=null;
            $partner_id=null;
            $tenant_id=null;
            $area_id=null;
            $engineer_id=null;
            $plan_type_id=null;
            $site_id=null;
            $product_code=null;

            $colom_name = array("company","siteid","floc_site","tenant_code","floc","area","partner","tenant","engineer","product","type","start_date","end_date","next_date");
            for ($i=0;$i<count($colom_name);$i++) {
                ${$colom_name[$i]} =$row[$i];
            }
      
            $getdata=$this->dataGet("local_company_byname_{$company}","SERVER_SHARED_MASTER_DATA","local/company/name/{$company}");
            if($getdata){
                $company_id = $getdata->code;
            } else  {
                $isFail=true;
                $error_company_id++;
            }
                

            $getdata=$this->dataGet("local_partner_byname_{$partner}","SERVER_SHARED_MASTER_DATA","local/partner/name/{$partner}");
            if($getdata){
                    $partner_id = $getdata->code;
            } else {
                $error_partner_id++;
                $isFail=true;
            }
            $getdata=$this->dataGet("local_tenant_byname_{$tenant}","SERVER_SHARED_MASTER_DATA","local/tenant/name/{$tenant}");
            if($getdata){
                    $tenant_id = $getdata->id;
            } else {
                $error_tenant_id++;
                $isFail=true;
            }

            $getdata=$this->dataGet("local_engineer_byname_{$engineer}","SERVER_AUTH","local/profile/name/{$engineer}");
            if($getdata){
                    $engineer_id = $getdata->id;
            } else {
                $error_engineer_id++;
                $isFail=true;
            }

            $getdata=$this->dataGet("local_plan_type_byname_{$type}","SERVER_WO_TOWER","local/plantype/name/{$type}");
            if($getdata){
                    $plan_type_id = $getdata->id;
            } else {
                $error_plan_type_id++;
                $isFail=true;
            }
            $getdata=$this->dataGet("local_area_type_byname_{$area}","SERVER_SHARED_MASTER_DATA","local/area/name/{$area}");
            if($getdata){
                    $area_id = $getdata->id;
            } else {
                $error_area_id++;
                $isFail=true;
            }

            $getdata=$this->dataGet("local_siteid_byname_{$siteid}","SERVER_SHARED_MASTER_DATA","local/sites/name/{$siteid}");
            if($getdata){
                    $site_id = $getdata->id;
            } else { 
                $error_site_id++;
                $isFail=true;
            }

            $getdata=$this->dataGet("local_product_byname_{$product}","SERVER_SHARED_MASTER_DATA","local/product/name/{$product}");
            if($getdata){
                    $product_code = $getdata->id;
            } else { 
                $error_product_code++;
                $isFail=true;
            }

            $start_date = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($start_date))->format('Y-m-d');
            $end_date = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($end_date))->format('Y-m-d');
            $next_date = \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($next_date))->format('Y-m-d');
           
            Log::info($uuid->toString()."| {$company_id} - {$partner_id} - {$tenant_id} - {$area_id} - {$engineer_id} - {$plan_type_id} - {$product_code} - {$site_id} - {$start_date} - {$end_date} - {$next_date}");
        
            $form_id=1;
            if($partner_id === "ipa"){
                $total_row_ipa++;
            } else if($partner_id === "hup"){
                $total_row_hup++;
            }
        

            try{   
                if($isFail){
                    $total_row_fail++;
                } else {
                    $check_sch = Draft::where('site_id', $site_id)->where('form_id',$form_id)->where('plan_type',$plan_type_id)->whereNull('deleted_at')->first();
                    if($check_sch === null){
                        $draft = Draft::create([
                            'batch_id' =>$batch_id,
                            'code' => $uuid->toString(),
                            'site_id' => $site_id,
                            'work_type_id' => 1,
                            'form_id' => $form_id,
                            'area_id' => $area_id,
                            'company_code' => $company_id,
                            'partner_code' => $partner_id,
                            'plan_type' => $plan_type_id,
                            'product_code' => 'macro',
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'next_date' => $next_date,
                        ]);
                        
                        if($draft){
                            $draftid=$draft->id;
                            $check_engineer = DraftHasEngineer::where('draft_id', $draftid)->where('user_id',$engineer_id)->first();
                            if($check_engineer === null){
                                DraftHasEngineer::create([
                                    'draft_id' =>  $draftid,
                                    'user_id' => $engineer_id,
                                ]);

                                Log::info("assign engineer success");
                            }

                            $check_tenant = DraftHasTenant::where('floc', $floc)->first();
                            if($check_tenant === null){
                                DraftHasTenant::create([
                                    'draft_id' => $draftid,
                                    'tenant_id' => $tenant_id,
                                    'floc' => $floc
                                ]);

                                Log::info("assign tenant success");
                            }
                        }
                    
                    } else {
                        $check_tenant = DraftHasTenant::where('floc', $floc)->first();
                        if($check_tenant === null){
                            $draftid=$check_sch->id;
                            DraftHasTenant::create([
                                'draft_id' => $draftid,
                                'tenant_id' => $tenant_id,
                                'floc' => $floc
                            ]);

                            Log::info("assign tenant success");
                        }
                    }

                    $total_row_success++;
                }
            } catch(\Exception $e) {
                Log::warning($e->getMessage());
            }
            $row_number++;

            $OrmImportHistory = ImportHistory::find($importHistory->id);
            $OrmImportHistory->record = $row_number;
            $OrmImportHistory->save();
            
        }

        $error_notfound = array(
            "company_id" =>$error_company_id,
            "partner_id" =>$error_partner_id,
            "tenant_id" =>$error_tenant_id,
            "area_id" =>$error_area_id,
            "engineer_id" =>$error_engineer_id,
            "plan_type_id" =>$error_plan_type_id,
            "site_id" =>$error_site_id,
        );

        $total=array(
           "total_row_success" => $total_row_success,
           "total_row_fail"=> $total_row_fail,
            "total_row_ipa"=>$total_row_ipa,
            "total_row_hup"=>$total_row_hup
        );

        $report=array(
            "error"=>$error_notfound,
            "total"=>$total
        );

        $OrmImportHistory = ImportHistory::find($importHistory->id);
        $OrmImportHistory->result = json_encode($report);
        $OrmImportHistory->filename = $this->file;
        $OrmImportHistory->status = "done";
        $OrmImportHistory->save();

        Log::info("userid=> ".$this->userid);
        Log::info("file=> ".$this->file);
        Log::info("report=> ".json_encode($report));

        //return $report;
        //Log::info(implode("-",$error_notfound));
        
    }

    public function startRow(): int {
        return 2;
    }

    public function chunkSize(): int
    {
        return 200;
    }

    function dataGet($key, $server, $uri){
        $ttl = 2 * 60;

        $client = new Client([
            'base_uri' => env($server,null),
            'timeout'  => 10.0
        ]);

        try {
            //Log::info($uri);
            $body = Cache::remember($key, $ttl, function () use ($client,$uri) {
                $response = $client->request('GET', $uri);
                return  (string)$response->getBody();
            });

            $dataresp=array();
            if($body != null){
                $obj = json_decode($body);
                if(!$obj->success)
                    return null;

                if($obj->data)
                    $dataresp=$obj->data;
            }

            return $dataresp;

        } catch (RequestException $e) {
            Log::warning($e->getMessage());
            return null;
        } catch (ConnectException $e) {
            Log::warning($e->getMessage());
            return null;
        }
    }

    public function generateKey() {
        
        $charsetnumber = "1234567890";
        $key_number = '';
        for ($i = 0; $i < 5; $i++) {
            $key_number .= $charsetnumber[(mt_rand(0, strlen($charsetnumber) - 1))];
        }

        $charset = $key_number;
        $key = str_shuffle($charset);
        return $key;
        
    }

}
