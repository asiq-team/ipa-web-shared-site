<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftHasTenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_wo_draft')->create('draft_has_tenant', function (Blueprint $table) {
            $table->foreignId('draft_id')->constrained('draft')->onDelete('cascade');
            $table->integer("tenant_id");
            $table->string("floc",150);
            
            $table->index('draft_id');
            $table->index('tenant_id');
            $table->index('floc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_wo_draft')->dropIfExists('draft_has_tenant');
    }
}
