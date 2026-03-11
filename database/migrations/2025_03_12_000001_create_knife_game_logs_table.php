<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnifeGameLogsTable extends Migration
{
    public function up()
    {
        Schema::create('knife_game_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('bet', 12, 2);
            $table->unsignedTinyInteger('knife_count');
            $table->json('knife_indices');
            $table->json('revealed_indices');
            $table->string('status', 20)->default('playing');
            $table->decimal('profit', 12, 2)->default(0);
            $table->decimal('multiplier', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'created_at']);
            $table->index(['status', 'profit']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('knife_game_logs');
    }
}
