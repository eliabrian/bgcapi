<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string(column: 'name');
            $table->string(column: 'slug');
            $table->foreignUuid(column: 'tag_id')
                ->constrained();
            $table->foreignUuid(column: 'difficulty_id')
                ->constrained();
            $table->smallInteger(column: 'player_min');
            $table->smallInteger(column: 'player_max');
            $table->smallInteger(column: 'age');
            $table->smallInteger(column: 'duration');
            $table->text(column: 'summary');
            $table->text(column: 'description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
