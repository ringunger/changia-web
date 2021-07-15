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
            $table->foreignId('entreaty_id')->references('id')->on('entreaties');
            $table->string("mcc_network");
            $table->string("mnc_network");
            $table->string("network_name");
            $table->string("amount_collected");
            $table->string("transaction_id");
            $table->string("subscriber_msisdn");
            $table->string("source_currency");
            $table->string("target_currency");
            $table->string("reference_number");
            $table->string("paybill_number");
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
