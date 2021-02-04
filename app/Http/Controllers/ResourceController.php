<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Helpers\ApiRequest as Api;

use App\Models\Draft;

use Illuminate\Support\Facades\Cache;
use App\Models\User;

class ResourceController extends Controller
{
    function plantype(){
        $data = Api::Get("resource_plantype_all","SERVER_WO_TOWER","local/plantype");
        return $data;
    }

    function tenant(){
        $data = Api::Get("resource_tenant_all","SERVER_SHARED_MASTER_DATA","local/tenant");
        return $data;
    }

    function product(){
        $data = Api::Get("resource_product_bygroup","SERVER_SHARED_MASTER_DATA","local/product/group?group=tower");
        return $data;
    }

    function form(){
        $data = Api::Get("resource_form","SERVER_FORM","local/form");
        return $data;
    }

    function findEngineer(Request $request){
        if ($request->has('q')) {
            $find=$request->q;
            $data = User::where("username","LIKE","%{$find}%")->selectRaw("username, user_key")->get();
            return response()->json($data);
        }
    }


    
}
