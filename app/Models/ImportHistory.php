<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_wo_draft';
    protected $table = 'import_history';
    protected $guarded = array();
}
