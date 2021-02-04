<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Cache;

use App\Http\Helpers\ApiRequest as Api;
use App\Jobs\ReleaseWorkorderJob;
use App\Models\Draft;
use App\Models\Plan;
use App\Models\DraftHasTenant;
use App\Models\DraftHasEngineer;

class PlanToReleaseWorkorder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workorder:release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Draft plan to release plan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ttl = 2 * 60;
        try {
            $collect=array();
            $draftplan = Cache::remember("all_draftplan_wo", $ttl, function ()  {
                return Plan::all();
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
                    $form_id = $value['form_id'];
                  
                    $engineer_id = Cache::remember("engineer_by_draftid_{$draftid}", $ttl, function () use ($draftid) {
                        return DraftHasEngineer::where("draft_id",$draftid)->first();
                    });
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
    
                    $company_code=$value['company_code'];
                    //$floc_site="{$company_code}-{$sitecodesap}";
                    $collect[]=array(
                        "batch"=>$value->batch_id,
                        "workorder_id"=>$draftcode,
                        "site_id"=>$siteid,
                        "engineer"=>$engineer,
                        "tenant"=>$tenantid,
                        "deleted_at"=>$value->deleted_at,
                        "work_date" => $draftplan_date,
                        "work_type"=>1,
                        "form_id"=>$form_id,
                        
                    );
    
                    //dd($collect);
                }    
            }  
            //dd($collect);
            //$job = (new ReleaseWorkorderJob($collect));//->onQueue($partner_conf);
            //$this->dispatch($job);
            ReleaseWorkorderJob::dispatch($collect)->onQueue('ipa');
            echo "done\n";
        } catch (\Exception $e) {
            Log::warning($e->getMessage());
            echo $e->getMessage();
            return null;
        } 
    }
}
