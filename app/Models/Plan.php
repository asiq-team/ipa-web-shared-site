<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_wo_draft';
    protected $table = 'draft_plan';
    protected $guarded = array();
    public $timestamps = false;
    protected $primaryKey = 'draft_id';
}
