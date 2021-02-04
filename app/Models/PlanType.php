<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    use HasFactory;
    protected $table = 'plant_type';

    public function getPlanByName($id){
        $data = PlanType::where("name",$id)->first();

        return $data;
    }
}
