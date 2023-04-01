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
        Schema::create('staff_accounts', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
            $table->bigIncrements('staff_account_id');
            $table->string('login_id', 20);
            $table->string('password', 120);
            $table->string('last_name', 80);
            $table->string('first_name', 80);
            $table->string('email_address', 80);
            $table->tinyInteger('sex_type_code')->default(0);
            $table->dateTime('birthday')->useCurrent();
            $table->tinyInteger('staff_account_type_code')->default(0);
            $table->tinyInteger('employment_type_code')->default(0);
            $table->tinyInteger('staff_account_status_code')->default(0);
            $table->dateTime('password_reset_datetime')->useCurrent();
            $table->boolean('is_account_lock')->default(false);
            $table->dateTime('last_login_datetime')->useCurrent();

            $table->bigInteger('created_account_id')->default(0);
            $table->bigInteger('created_account_login_id')->default(0);
            $table->string('created_account_name',120)->default('');
            $table->dateTime('created_datetime')->useCurrent();
            $table->bigInteger('updated_account_id')->default(0);
            $table->bigInteger('updated_account_login_id')->default(0);
            $table->string('updated_account_name', 120)->default('');
            $table->dateTime('updated_datetime')->useCurrent();
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
        Schema::dropIfExists('staff_accounts');
    }
};
