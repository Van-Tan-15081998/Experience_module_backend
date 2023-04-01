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
        Schema::create('favorite_app__knowledge', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
            $table->bigIncrements('knowledge_id');
            $table->string('title');
            $table->longText('content');
            $table->string('citation_source');
            $table->tinyInteger('same_level_sequence');
            $table->bigInteger('parent_knowledge_code');
            $table->bigInteger('subject_code');
            $table->string('picture');
            $table->boolean('is_important');
            $table->string('border_color');
            $table->boolean('is_favourite');
            $table->string('size_picture');
            $table->tinyInteger('tree_level');

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
        Schema::dropIfExists('favorite_app__knowledge');
    }
};
