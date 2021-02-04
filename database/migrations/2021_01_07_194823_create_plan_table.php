<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_wo_draft')->create('draft_plan', function (Blueprint $table) {
            $table->unsignedBigInteger("draft_id")->unique();
            $table->date('date_plan')->nullable();

            $table->index('draft_id');
            $table->index('date_plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_wo_draft')->dropIfExists('draft_plan');
    }
}
