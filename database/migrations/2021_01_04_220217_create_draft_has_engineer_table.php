<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftHasEngineerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_wo_draft')->create('draft_has_engineer', function (Blueprint $table) {
            $table->foreignId('draft_id')->constrained('draft')->onDelete('cascade');
            $table->bigInteger("user_id");

            $table->index('draft_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_wo_draft')->dropIfExists('draft_has_engineer');
    }
}
