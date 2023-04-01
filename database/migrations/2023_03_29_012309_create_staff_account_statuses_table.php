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
        Schema::create('staff_account_statuses', function (Blueprint $table) {
            $table->bigIncrements('staff_account_status_id');
            $table->string('processing_key')->default('');
            $table->string('name')->default('');

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
        Schema::dropIfExists('staff_account_statuses');
    }
};
