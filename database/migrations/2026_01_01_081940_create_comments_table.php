<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
     if (! Schema::hasTable('comments')) {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_by')->nullable();
            $table->morphs('commentable'); 
            $table->text('comment');
            $table->timestamps();
        });
    }
}
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
