<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('company')->nullable();
            $table->string('company_address')->nullable();
            $table->string('client_type');
            $table->string('market_source');
            $table->timestamps();
        });

        DB::table('clients')->insert(
            array(
                array('firstname' => 'Jetro','lastname' => 'Macalipay', 'client_type' => 'Option 1', 'market_source' => 'Marketplace'))
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
