<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');        // login, logout, create, update, delete
            $table->string('module');        // Auth, Project, Budget, Inventory, User, Feedback
            $table->text('description');
            $table->string('ip_address')->nullable();
            $table->json('changes')->nullable(); // before/after snapshot
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_trails');
    }
};
