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
         * 'ka'    <=>     'knowledge_article'
         **/
        Schema::create('kam__ka_content_unit_ka_related_content_unit_allocations', function (Blueprint $table) {
            $table->bigIncrements('ka_content_unit_ka_related_content_unit_allocation_id');
            $table->bigInteger('knowledge_article_content_unit_id');
            $table->bigInteger('knowledge_article_related_content_unit_id');

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
        Schema::dropIfExists('kam__ka_content_unit_ka_related_content_unit_allocations');
    }
};
