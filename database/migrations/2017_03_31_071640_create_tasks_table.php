<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    private $table = "tasks";

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table)
        {
            $table->increments('id');

            $table->enum("type",[
                "notify"
            ]);

            $table->integer("resource_id");

            $table->timestamps();
            $table->softDeletes();
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
