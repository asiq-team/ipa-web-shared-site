<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftHasEngineer extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_wo_draft';
    protected $table = 'draft_has_engineer';
    protected $guarded = array();
    public $timestamps = false;
    protected $primaryKey = 'draft_id';
}
