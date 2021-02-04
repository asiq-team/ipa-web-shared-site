<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;

use App\Models\Draft;
use App\Models\Plan;

use App\Http\Helpers\ApiRequest as Api;
use Illuminate\Support\Facades\Log;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ttl = 60;

        $partner = json_encode($request->session()->get('user'));
        $draftActive = Cache::remember("draft_count_active", $ttl, function () {
                return Draft::whereNull('deleted_at')->count();
        });
        $draftDeleted = Cache::remember("draft_count_delete", $ttl, function () {
                return Draft::whereNotNull('deleted_at')->count();
        });

        $plan = Cache::remember("plan_wo_count", $ttl, function () {
            return Plan::all()->count();
        });

        $release = 0;
        $partnerconfig=config('asiq.application.partner');
        $groupconfig=config('asiq.application.group');
        $getdata=Api::Get("local_workorder_all_count","SERVER_WO_TOWER","local/{$partnerconfig}/{$groupconfig}/workorder/statistik");
        if($getdata){
            $release = $getdata->count;
        }
        
        $total = $draftActive + $draftDeleted;
        return view('web.workorders.overview',['release'=>$release,'plan'=>$plan,'draft'=>array("active"=>$draftActive,"delete"=>$draftDeleted,"total"=>$total)]);
    }

    public function release()
    {
        $partner = config('asiq.application.partner');
        $group = config('asiq.application.group');
        $endpoint_wo = env('SERVER_WO_VIEW')."/api/{$partner}/{$group}/v1/workorder/datatable";
        return view('web.workorders.release',['partner'=>$partner,"endpoint_wo"=>$endpoint_wo]);
    }

    public function releaseShow($id)
    {
        $partner = config('asiq.application.partner');
        $group = config('asiq.application.group');
        $endpoint_wo = env('SERVER_WO_VIEW')."/api/{$partner}/{$group}/v1/workorder/datatable";

        $release=array();
        $getdata=Api::Get("local_workorder_bycode_{$id}","SERVER_WO_TOWER","local/{$partner}/{$group}/workorder/show/{$id}",25,10*60);
        if($getdata){
            $release = $getdata;
        }

        Log::info(print_r($release,true));

        return view('web.workorders.release-show',['partner'=>$partner,"endpoint_wo"=>$endpoint_wo,"workorders"=>$release]);
    }
}
