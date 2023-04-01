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
        Schema::create('favorite_app__songs', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
            $table->bigIncrements('song_id');
            $table->string('title', 120);
            $table->bigInteger('author_code');
            $table->bigInteger('category_code');
            $table->bigInteger('singer_code');
            $table->longText('lyrics');
            $table->bigInteger('band_code');
            $table->bigInteger('album_code');
            $table->tinyInteger('length');
            $table->date('release_date');
            $table->tinyInteger('total_listens');
            $table->tinyInteger('language_code');
            $table->bigInteger('producer_code');
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
        Schema::dropIfExists('favorite_app__songs');
    }
};
