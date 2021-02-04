<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_wo_draft')->create('draft', function (Blueprint $table) {
            $table->id();
            $table->string("batch_id",64);
            $table->string("code",64)->unique();
            $table->bigInteger("site_id");
            $table->integer("work_type_id");
            $table->integer("form_id");
            $table->integer("area_id");
            $table->string("company_code",50)->nullable();
            $table->string("partner_code",50);
            $table->integer("plan_type");
            $table->string("product_code",50);
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->date("next_date")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('id');
            $table->index('batch_id');
            $table->index('code');
            $table->index('site_id');
            $table->index('product_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_wo_draft')->dropIfExists('draft');
    }
}
