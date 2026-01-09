<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
    if(!Schema::hasTable('audit_logs')){
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('auditlogable');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('event')->nullable();
            $table->text('old_values')->nullable();
            $table->text('new_values')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};

