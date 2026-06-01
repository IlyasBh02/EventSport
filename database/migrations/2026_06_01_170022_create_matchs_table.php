<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('equipe_a');
            $table->string('equipe_b');
            $table->dateTime('date_match');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matchs');
    }
};
