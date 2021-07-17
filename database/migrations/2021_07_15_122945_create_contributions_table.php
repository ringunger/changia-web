<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->string("mcc_network")->nullable();
            $table->string("mnc_network")->nullable();
            $table->string("network_name")->nullable();
            $table->string("amount_collected");
            $table->string("transaction_id");
            $table->string("subscriber_msisdn");
            $table->string("source_currency")->nullable();
            $table->string("target_currency")->nullable();
            $table->string("reference_number");
            $table->string("paybill_number")->nullable();
            $table->string("timestamp");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contributions');
    }
}
