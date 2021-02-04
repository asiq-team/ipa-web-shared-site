<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_wo_draft')->create('import_history', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("batch_id",64);
            $table->string("filename",250)->nullable();
            $table->text("result")->nullable();
            $table->integer("record")->default(0);
            $table->string("status",15)->default('start');
            $table->timestamps();

            $table->index('id');
            $table->index('user_id');
            $table->index('batch_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_wo_draft')->dropIfExists('import_history');
    }
}
