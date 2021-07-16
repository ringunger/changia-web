<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sent_messages', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->string("successful")->nullable();
            $table->string('request_id')->nullable();
            $table->string('code')->nullable();
            $table->text('message')->nullable();
            $table->text('valid')->nullable();
            $table->text('invalid')->nullable();
            $table->text('duplicates')->nullable();
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
        Schema::dropIfExists('sent_messages');
    }
}
