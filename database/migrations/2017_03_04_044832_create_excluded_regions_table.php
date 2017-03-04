<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcludedRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $table = "exclusions";

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE " . $this->table . " ADD location POINT");
        Schema::table($this->table, function (Blueprint $table)
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
        Schema::table($this->table, function (Blueprint $table)
        {
            Schema::drop($this->table);
        });
    }
}
