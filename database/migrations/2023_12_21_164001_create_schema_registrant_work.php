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
        Schema::create('schema_registrant_work', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('schema_registrant_id')->comment('Relation to table schema_registrant');
            $table->string('company_name');
            $table->string('position');
            $table->string('address');
            $table->string('email');
            $table->string('telp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schema_registrant_work');
    }
};
