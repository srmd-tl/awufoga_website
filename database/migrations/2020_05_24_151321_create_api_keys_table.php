<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_api_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('key_type_id');
            $table->string('key');
            $table->string('value');
            $table->text('description');
            $table->boolean('status');
            $table->timestamps();

            /*Foreign Kyes*/
            $table->foreign('key_type_id')->references('id')->on('key_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_api_keys');
    }
}
