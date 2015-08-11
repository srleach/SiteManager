<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->increments('id');
            $table->string('name');
            $table->string('passphrase');
            $table->integer('creator_id')->unsigned();
            $table->foreign('creator_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->text('key_path');
        });

        Schema::create('connections', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();
            $table->increments('id');
            $table->string('name');
            $table->integer('creator_id')->unsigned();
            $table->foreign('creator_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('host');
            $table->integer('port');
            $table->string('username');
            $table->string('password');
            $table->boolean('uses_key');
            $table->integer('key')->unsigned();
            $table->foreign('key')
                ->references('id')->on('keys')
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
