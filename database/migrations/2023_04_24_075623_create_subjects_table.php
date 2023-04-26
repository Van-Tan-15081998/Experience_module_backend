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
        /**
         * 'kam'    <=>     'knowledge_article_master'
         **/
        Schema::create('kam__subjects', function (Blueprint $table) {
            $table->bigIncrements('subject_id');
            $table->string('title', 240)->default('');
            $table->tinyInteger('level')->default(1);
            $table->tinyInteger('sequence')->default(1);
            $table->bigInteger('parent_subject_code')->default(0);
            $table->bigInteger('root_subject_code')->default(0);

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
        Schema::dropIfExists('kam__subjects');
    }
};
