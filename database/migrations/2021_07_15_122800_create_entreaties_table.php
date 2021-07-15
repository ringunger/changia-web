<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreatiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreaties', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->double('target_amount', 19, 4)->nullable();
            $table->foreignId('currency_id')->default(1)->references('id')->on('currencies');
            $table->dateTime('deadline')->nullable();
            $table->tinyInteger('is_public')->default(1);
            $table->tinyInteger('is_published')->default(0);
            $table->dateTime('published_date')->nullable();
            $table->enum('status', ['DRAFT', 'PUBLISHED', 'CANCELLED', 'COMPLETED'])->default('DRAFT');
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
        Schema::dropIfExists('entreaties');
    }
}
