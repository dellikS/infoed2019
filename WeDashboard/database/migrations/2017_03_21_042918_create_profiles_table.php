<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('birth_date')->nullable();
            $table->integer('country_id')->nullable()->unsigned()->index();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->text('bio')->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('github_username')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('avatar_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
