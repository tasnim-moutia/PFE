<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->nullable()->constrained('messages')->onDelete('cascade');;
            $table->foreignId('sender_id')->nullable()->constrained('users')->onDelete('cascade');;
            $table->foreignId('receiver_id')->nullable()->constrained('users')->onDelete('cascade');;
            $table->tinyInteger('type')->default(0)
                ->comment('1:group message, 0:personal message');
            $table->tinyInteger('seen_status')->default(0)
                ->comment('1:seen');
            $table->tinyInteger('deliver_status')->default(0)
                ->comment('1:delivered');
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
        Schema::dropIfExists('user_messages');
    }
}
