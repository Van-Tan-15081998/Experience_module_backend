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
        Schema::create('favorite_app__books', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
            $table->bigIncrements('book_id');
            $table->string('title', 120)->default('');
            $table->bigInteger('author_code');
            $table->bigInteger('publisher_code');
            $table->bigInteger('category_code');
            $table->tinyInteger('edition')->default(0);
            $table->longText('content')->default('');
            $table->tinyInteger('total_pages')->default(0);
            $table->tinyInteger('format_code')->default(0);
            $table->longText('summary')->default('');
            $table->boolean('availability')->default(0);
            $table->tinyInteger('quantity')->default(0);
            $table->decimal('price')->default(0);
            $table->double('weight')->default(0);
            $table->string('cover_picture')->default('');
            $table->double('rating')->default(0);

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
        Schema::dropIfExists('favorite_app__books');
    }
};
