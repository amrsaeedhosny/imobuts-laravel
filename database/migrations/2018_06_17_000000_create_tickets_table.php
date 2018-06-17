<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tickets';

    /**
     * Run the migrations.
     * @table tickets
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('code')->nullable()->default(null);
            $table->float('price');
            $table->integer('passengerID')->nullable()->default(null);
            $table->timestamp('date')->nullable()->default(null);
            $table->tinyInteger('viewed')->default('0');

            $table->index(["passengerID"], 'fk_tickets_passengers_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
