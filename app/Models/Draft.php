<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Draft extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_wo_draft';
    protected $table = 'draft';
    protected $guarded = array();

    public function getWorkoder($id,$month,$year){
        $data = DB::table("draft")
        ->leftJoin("workorders","workorders.id","=","workorder_has_engineer.workorder_id")
        ->leftJoin("workorder_periode","workorder_periode.workorder_id","=","workorders.id")
        ->where("user_id",$id) 
        ->where("workorder_periode.month",$month)
        ->where("workorder_periode.year",$year)
        ->selectRaw("workorders.*,workorders.code as wo_code, workorder_periode.label as periode")
        ->get();

        return $data;
    }
}
