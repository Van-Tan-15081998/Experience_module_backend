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
        Schema::create('favorite_app__movies', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
            $table->bigIncrements('movie_id');
            $table->string('title', 120);
            $table->bigInteger('producer_code');
            $table->bigInteger('category_code');
            $table->longText('content');
            $table->tinyInteger('length');
            $table->date('release_date');
            $table->tinyInteger('total_views');
            $table->tinyInteger('nation_code');
            $table->bigInteger('director_code');
            $table->string('picture');
            $table->double('rating');

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
        Schema::dropIfExists('favorite_app__movies');
    }
};
