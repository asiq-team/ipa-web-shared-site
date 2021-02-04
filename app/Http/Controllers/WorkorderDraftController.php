<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\Imports\WorkorderImport;

use App\Jobs\ImportWorkorderJob;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\Facades\DataTables;

use App\Models\Draft;
use App\Models\DraftHasTenant;
use App\Models\DraftHasEngineer;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use App\Http\Helpers\ApiRequest as Api;
use App\Models\Plan;
use Exception;

use Illuminate\Support\Facades\Storage;

class WorkorderDraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner = env('APP_PARTNER','');
        return view('web.workorders.draft',['partner'=>$partner]);
    }

    public function plan()
    {
        $partner = env('APP_PARTNER','');
        return view('web.workorders.plan',['partner'=>$partner]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $ttl = 2 * 60;

        $client = new Client([
            'base_uri' => env("SERVER_SHARED_MASTER_DATA",null),
            'timeout'  => 15.0
        ]);

        $collect=array();
        $draft=Cache::remember("draft_find_bycode_{$id}", 5 * 60, function () use ($id){
            return Draft::where("code", $id)->get();
        });
           
        foreach($draft as $value){
           // $collect[]=$value;
            $draftid= $value->id;
            $draftcode= $value->code;
            $siteid = $value['site_id'];
            $sitename = "";
            $sitecode = "";
            $sitecodesap = "";
            $getdata=Api::Get("local_siteid_byid_{$siteid}","SERVER_SHARED_MASTER_DATA","local/sites/{$siteid}");
            if($getdata){
                $siteid = $getdata->id;
                $sitename = $getdata->name;
                $sitecode = $getdata->code;
                $sitecodesap = $getdata->code_sap;
            } 

            $plan_type = $value['plan_type'];
            $plan_label="";
           $getdata=Api::Get("local_plan_type_byud_{$plan_type}","SERVER_WO_TOWER","local/plantype/{$plan_type}");
            if($getdata){
                $plan_label = $getdata->name;
            }

            $engineer_id = Cache::remember("engineer_by_draftid_{$draftid}", $ttl, function () use ($draftid) {
                return DraftHasEngineer::where("draft_id",$draftid)->first();
            });

            $engineer="";
            if($engineer_id !== null){
                $engineer=$engineer_id->user_id;
            }

            $tenant =array();
            $datatenant = Cache::remember("tenant_by_draftid_{$draftid}", $ttl, function () use ($draftid) {
                return DraftHasTenant::where("draft_id",$draftid)->get();
            });

            $tenantid=array();
            foreach($datatenant as $valt){
                $tenantid[]=$valt->tenant_id;
            }

            $product_code=$value->product_code;
            $product_name="";
            $getdata = Api::Get("local_product_bycode_{$product_code}","SERVER_SHARED_MASTER_DATA","local/product/name/{$product_code}");
            if($getdata){
                $product_name = $getdata->name;
            } 

            $form_id=$value->form_id;
            $form_name="";
            $getdata = Api::Get("local_form_byid_{$form_id}","SERVER_FORM","local/form/{$form_id}");
            if($getdata){
                $form_name = $getdata->name;
            } 


            $area="JABODETABEK-BANTEN";
            $company_code=$value['company_code'];
            $floc_site="{$company_code}-{$sitecodesap}";
            $collect[]=array(
                "batch"=>$value->batch_id,
                "workorder_id"=>$draftcode,
                "site_id"=>$siteid,
                "site_name"=>$sitename,
                "site_code"=>$sitecode,
                "site_code_sap"=>$sitecodesap,
                "floc_site"=>$floc_site,
                "plan"=>$plan_type,
                "plan_label"=>$plan_label,
                "area"=>$area,
                "engineer"=>$engineer,
                "tenant"=>$tenantid,
                "product"=>$product_name,
                "product_code"=>$product_code,
                "deleted_at"=>$value->deleted_at,
                "form_id"=>$form_id,
                "form"=>$form_name
            );

            //dd($collect);
        }      
        
        return $collect;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userkey=Auth::user()->user_key;
        return view('web.workorders.draft-edit',["id"=>$id,"token"=>$userkey]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plantype=$request->plantype;
        $product=$request->product;
        $formtype=$request->formtype;
        $case=$request->case;

        switch($case){
            case "general":
                $model = Draft::where("code",$id);
                $model->plan_type = $plantype;
                $model->product_code = $product;
                $model->form_id = $formtype;

                try{
                    $model->save();
                    return response()->json(["status"=>true]);
                } catch (\Exception $e){
                    return response()->json(["status"=>false,"message"=>$e->getMessage()]);
                    Log::error("update error => ".$e->getMessage());
                }
                break;

        }

        return response()->json(["status"=>false,"message"=>"not found"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import()
    {
        //$partner = env('APP_PARTNER','');
        return view('web.workorders.import');
    }

    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json("File harus terisi");
        }

        
        try {
            $file='file_import/'.$request->file;
            $partner_conf = config('asiq.application.partner','stp');
            Log::info($partner_conf);
            ImportWorkorderJob::dispatch($file,Auth::id());//->onQueue($partner_conf);
            return response()->json("ok");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(["error"=>$e->getMessage()]);
        }
    }

    public function provideData(Request $request){

        $ttl = 2 * 60;

        $client = new Client([
            'base_uri' => env("SERVER_SHARED_MASTER_DATA",null),
            'timeout'  => 15.0
        ]);

        $collect=array();
        $offset=$request->start;
        $length=$request->length;
        $draft = Cache::remember("all_draft_wo_{$offset}_{$length}", $ttl, function () use ($length,$offset) {
            return Draft::orderby("created_at", "desc")->offset($offset)->limit($length)->get();
        });
        $draft_total = Cache::remember("all_draft_wo_total", $ttl, function () use ($length,$offset) {
            return Draft::count();
        });
        foreach($draft as $value){
           // $collect[]=$value;
            $draftid= $value->id;
            $draftcode= $value->code;
            $siteid = $value['site_id'];
            $sitename = "";
            $sitecode = "";
            $sitecodesap = "";
            $getdata=$this->dataGet("local_siteid_byid_{$siteid}","SERVER_SHARED_MASTER_DATA","local/sites/{$siteid}");
            if($getdata){
                    $siteid = $getdata->id;
                    $sitename = $getdata->name;
                    $sitecode = $getdata->code;
                    $sitecodesap = $getdata->code_sap;
            } 

            $plan_type = $value['plan_type'];
            $getdata=$this->dataGet("local_plan_type_byud_{$plan_type}","SERVER_WO_TOWER","local/plantype/{$plan_type}");
            if($getdata){
                $plan_type = $getdata->name;
            }

            $engineer_id = Cache::remember("engineer_by_draftid_{$draftid}", $ttl, function () use ($draftid) {
                return DraftHasEngineer::where("draft_id",$draftid)->first();
            });
            $engineer="";
            if($engineer_id !== null){
                $engineer=$engineer_id->user_id;
                $getdata=$this->dataGet("local_engineer_byid_{$engineer}","SERVER_AUTH","local/profile/id/{$engineer}");
                if($getdata){
                        $engineer = $getdata->username;
                }
            }

            $tenant =array();
            $tenant_logo ="";
            $datatenant = Cache::remember("tenant_by_draftid_{$draftid}", $ttl, function () use ($draftid) {
                return DraftHasTenant::where("draft_id",$draftid)->get();
            });

            $tenantid=array();
            foreach($datatenant as $valt){
                $tenantid[]=$valt->tenant_id;
            }
            $tenantid=array(
                'data' => $tenantid,
            );

            try {
                $body = Cache::remember("tenant_array_byworkorder_{$draftid}", $ttl, function () use ($client,$tenantid) {
                    $response = $client->request('POST', "local/tenant/array", ['json' =>$tenantid]);
                    return  (string)$response->getBody();
                });

                $dataresp=array();
                if($body != null){
                    $obj = json_decode($body);
                    if(($obj->data)){
                        //Log::info($obj->data);
                        foreach($obj->data as $obj){
                            $dataresp=$obj;
                            $logo="";
                            if($dataresp->logo != "" || $dataresp->logo != null){
                                $logo=env("APP_URL",null)."/masterdata".$dataresp->logo;
                            }
                            $tenant[]=array(
                                "id"=> $dataresp->id,
                                "name"=> $dataresp->name,
                                "company"=> $dataresp->company,
                                "logo"=> $logo
                            );
                        }
                    }
                }
            } catch (RequestException $e) {
                Log::warning($e->getMessage());
            }catch (ConnectException $e) {
                Log::warning($e->getMessage());
            } catch (\ErrorException $e){
                Log::warning($e->getMessage());
            }

            

            $area="JABODETABEK-BANTEN";
            $company_code=$value['company_code'];
            $floc_site="{$company_code}-{$sitecodesap}";
            $collect[]=array(
                "batch"=>$value->batch_id,
                "workorder_id"=>$draftcode,
                "site_name"=>$sitename,
                "site_code"=>$sitecode,
                "floc_site"=>$floc_site,
                "plan"=>$plan_type,
                "area"=>$area,
                "engineer"=>$engineer,
                "tenant"=>$tenant,
                "deleted_at"=>$value->deleted_at
            );

            //dd($collect);
        }      
        
        return DataTables::collection($collect)->setTotalRecords($draft_total)->skipPaging()->toJson();
    }

    public function provideDataPlan(Request $request){

        $ttl = 10 * 60;

        $client = new Client([
            'base_uri' => env("SERVER_SHARED_MASTER_DATA",null),
            'timeout'  => 15.0
        ]);

        $collect=array();
        $offset=$request->start;
        $length=$request->length;

        $draftplan = Cache::remember("all_draftplan_wo_{$offset}_{$length}", $ttl, function () use ($length,$offset) {
            return Plan::orderby("draft_id", "desc")->offset($offset)->limit($length)->get();
        });
        $draft_total = Cache::remember("all_draftplan_wo_total", $ttl, function () use ($length,$offset) {
            return Plan::count();
        });

        foreach($draftplan as $planvalue){
            $draftplan_id = $planvalue['draft_id'];
            $draftplan_date = $planvalue['date_plan'];

            $draft = Cache::remember("draft_wo_byid{$draftplan_id}", $ttl, function () use ($draftplan_id) {
                return Draft::where("id",$draftplan_id)->get();
            });
            foreach($draft as $value){
                $draftid= $value->id;
                $draftcode= $value->code;
                $siteid = $value['site_id'];
                $sitename = "";
                $sitecode = "";
                $sitecodesap = "";
                $getdata=$this->dataGet("local_siteid_byid_{$siteid}","SERVER_SHARED_MASTER_DATA","local/sites/{$siteid}");
                if($getdata){
                        $siteid = $getdata->id;
                        $sitename = $getdata->name;
                        $sitecode = $getdata->code;
                        $sitecodesap = $getdata->code_sap;
                } 

                $plan_type = $value['plan_type'];
                $getdata=$this->dataGet("local_plan_type_byud_{$plan_type}","SERVER_WO_TOWER","local/plantype/{$plan_type}");
                if($getdata){
                    $plan_type = $getdata->name;
                }

                $engineer_id = Cache::remember("engineer_by_draftid_{$draftid}", $ttl, function () use ($draftid) {
                    return DraftHasEngineer::where("draft_id",$draftid)->first();
                });
                $engineer="";
                if($engineer_id !== null){
                    $engineer=$engineer_id->user_id;
                    $getdata=$this->dataGet("local_engineer_byid_{$engineer}","SERVER_AUTH","local/profile/id/{$engineer}");
                    if($getdata){
                            $engineer = $getdata->name;
                    }
                }

                $tenant =array();
                $tenant_logo ="";
                $datatenant = Cache::remember("tenant_by_draftid_{$draftid}", $ttl, function () use ($draftid) {
                    return DraftHasTenant::where("draft_id",$draftid)->get();
                });

                $tenantid=array();
                foreach($datatenant as $valt){
                    $tenantid[]=$valt->tenant_id;
                }
                $tenantid=array(
                    'data' => $tenantid,
                );

                try {
                    $body = Cache::remember("tenant_array_byworkorder_{$draftid}", $ttl, function () use ($client,$tenantid) {
                        $response = $client->request('POST', "local/tenant/array", ['json' =>$tenantid]);
                        return  (string)$response->getBody();
                    });

                    $dataresp=array();
                    if($body != null){
                        $obj = json_decode($body);
                        if(($obj->data)){
                            //Log::info($obj->data);
                            foreach($obj->data as $obj){
                                $dataresp=$obj;
                                $logo="";
                                if($dataresp->logo != "" || $dataresp->logo != null){
                                    $logo=env("APP_URL",null)."/masterdata".$dataresp->logo;
                                }
                                $tenant[]=array(
                                    "id"=> $dataresp->id,
                                    "name"=> $dataresp->name,
                                    "company"=> $dataresp->company,
                                    "logo"=> $logo
                                );
                            }
                        }
                    }
                } catch (RequestException $e) {
                    Log::warning($e->getMessage());
                }catch (ConnectException $e) {
                    Log::warning($e->getMessage());
                } catch (\ErrorException $e){
                    Log::warning($e->getMessage());
                }

                

                $area="JABODETABEK-BANTEN";
                $company_code=$value['company_code'];
                $floc_site="{$company_code}-{$sitecodesap}";
                $collect[]=array(
                    "batch"=>$value->batch_id,
                    "workorder_id"=>$draftcode,
                    "site_name"=>$sitename,
                    "site_code"=>$sitecode,
                    "floc_site"=>$floc_site,
                    "plan"=>$plan_type,
                    "area"=>$area,
                    "engineer"=>$engineer,
                    "tenant"=>$tenant,
                    "deleted_at"=>$value->deleted_at,
                    "work_date" => $draftplan_date
                );

                //dd($collect);
            }    
        }  
        
        return DataTables::collection($collect)->setTotalRecords($draft_total)->skipPaging()->toJson();
    }

    function dataGet($key, $server, $uri){
        $ttl = 2 * 60;

        $client = new Client([
            'base_uri' => env($server,null),
            'timeout'  => 15.0
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

    function draftEdit($id){
        
    }
}
