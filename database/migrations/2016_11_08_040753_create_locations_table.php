<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $table = "points";

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table)
        {
            $table->increments('id');

            $table->string('title');
            $table->string('info')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE " . $this->table . " ADD location POINT");
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
