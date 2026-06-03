<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Otherinformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbz_postpgotherinfo', function (Blueprint $table) {
            $table->increments('postpgotherinfo_id'); 
            $table->unsignedInteger('postpgapp_sl_ref');
            $table->foreign('postpgapp_sl_ref')->references('postpgapp_sl')->on('tb_postpgapp');
            $table->string('postpgotherinfo_appid')->nullable();
            $table->integer('ph_status')->nullable();
            $table->integer('ph_type')->nullable();
            $table->integer('postpgjrf_option')->nullable();
            $table->string('postpgjrf_regno')->nullable();
            $table->integer('postpgjrf_year')->nullable();
            $table->integer('postpgemployment_option')->nullable();
            $table->string('postpgemployment_details')->nullable();
            $table->string('postpgemployment_teach_exp')->nullable();
            $table->integer('postpgpaperpublish_option')->nullable();
            $table->string('postpgpaperpublish_info')->nullable();
            $table->string('postpgapp_additional_info')->nullable();
                       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbz_postpgotherinfo');
    }
}
