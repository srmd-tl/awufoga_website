<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('admin', function (Blueprint $table) {
            DB::statement('ALTER TABLE admin MODIFY password  LONGTEXT;');
            $table->dropColumn('user_name');

            $table->dropColumn('identity');
            $table->string('name');
            $table->string('remember_token')->nullable();
 
            $table->string('email');
            // $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('remember_token');
            $table->string('user_name');
            $table->string('identity');

        });

    }
}
