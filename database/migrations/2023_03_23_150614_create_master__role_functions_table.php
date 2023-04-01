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
        Schema::create('master__role_functions', function (Blueprint $table) {
            $table->bigIncrements('role_function_id');
            $table->bigInteger('role_id');
            $table->bigInteger('function_id');
            $table->boolean('is_browser')->default(false);
            $table->boolean('is_registration')->default(false);
            $table->boolean('is_edit')->default(false);
            $table->boolean('is_delete')->default(false);
            $table->boolean('is_upload')->default(false);
            $table->boolean('is_download')->default(false);

            // $table->boolean('is_supreme_browser');
            // $table->boolean('is_supreme_edit');
            // $table->boolean('is_supreme_delete');
            // $table->boolean('is_supreme_upload');
            // $table->boolean('is_supreme_download');

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
        Schema::dropIfExists('master__role_functions');
    }
};
