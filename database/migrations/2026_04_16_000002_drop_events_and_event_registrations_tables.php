<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
    }

    public function down(): void
    {
        // Recreate events
        Schema::create('events', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title');
            $table->longText('content');
            $table->string('file_name');
            $table->string('file_path');
            $table->timestamps();
        });
        // Recreate event_registrations
        Schema::create('event_registrations', function ($table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('contact_number');
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
