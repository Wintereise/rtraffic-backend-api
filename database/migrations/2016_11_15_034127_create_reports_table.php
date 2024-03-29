<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('severity');

            $table->integer('user_id')->unsigned();

            $table->string('comment');
            $table->boolean('anonymous');

            $table->text('polypoints');

            //$table->string('media');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('reports', function (Blueprint $table)
        {
            $table->foreign('user_id')->references('id')
               ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            Schema::drop('reports');
        });
    }
}
