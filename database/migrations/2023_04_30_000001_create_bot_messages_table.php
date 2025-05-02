<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bot_messages', function (Blueprint $table) {
            $table->id();
            $table->uuid('thread_id');
            $table->unsignedBigInteger('user_id');
            $table->text('message');
            $table->text('response')->nullable();
            $table->timestamps();

            $table->foreign('thread_id')
                ->references('id')
                ->on('threads')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bot_messages');
    }
};