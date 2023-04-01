<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_research__positions', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
            $table->bigIncrements('position_id');
            $table->string('name');
            $table->string('description');
            $table->boolean('is_manager');

            $table->bigInteger('created_account_id')->nullable();
            $table->bigInteger('created_account_login_id')->nullable();
            $table->string('created_account_name',120)->default('');
            $table->dateTime('created_datetime')->useCurrent();
            $table->bigInteger('updated_account_id')->nullable();
            $table->bigInteger('updated_account_login_id')->nullable();
            $table->string('updated_account_name', 120)->default('');
            $table->dateTime('updated_datetime')->nullable();
            $table->tinyInteger('record_version')->default(0);
            $table->boolean('is_deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laravel_research__positions');
    }
};
