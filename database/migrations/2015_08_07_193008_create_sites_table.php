<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->increments('id');
            $table->string('name');
            $table->text('url');
            $table->string('env');
            $table->integer('creator_id')->unsigned();
            $table->foreign('creator_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
