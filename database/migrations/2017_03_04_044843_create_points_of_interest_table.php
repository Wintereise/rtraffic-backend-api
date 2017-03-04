<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsOfInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $table = "poi";

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('point_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table($this->table, function (Blueprint $table)
        {
            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->foreign('point_id')->references('id')
                ->on('points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->table, function (Blueprint $table)
        {
            Schema::drop($this->table);
        });
    }
}
