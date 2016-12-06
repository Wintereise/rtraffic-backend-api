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

            $table->integer('location_id')->unsigned();

            $table->enum('severity', [
                'gridlock', 'smo', 'normal', 'info'
            ]);

            $table->string('comment');
            $table->string('media');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('reports', function (Blueprint $table)
        {
            //Let's define foreign keys
            $table->foreign('location_id')
                ->references('id')
                ->on('locations');
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
