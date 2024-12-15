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
        Schema::create('schema', function (Blueprint $table) {
            $table->id();
            $table->text('thumbnails')->nullable();
            $table->string('title');
            $table->string('number');
            $table->string('certification')->nullable();
            $table->text('purpose')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schema');
    }
};
