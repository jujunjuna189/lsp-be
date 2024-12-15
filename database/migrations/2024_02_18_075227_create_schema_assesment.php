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
        Schema::create('schema_assesment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('schema_id');
            $table->string('schema_unit_code');
            $table->text('title');
            $table->boolean('is_heading');
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schema_assesment');
    }
};
