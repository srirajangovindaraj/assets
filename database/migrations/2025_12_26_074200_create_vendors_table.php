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
         Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('contact_person_name');
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('flat_no')->nullable();
            $table->string('street')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('pin')->nullable();
            $table->string('landmark')->nullable();
            $table->string('mobile_nbr', 15)->nullable();
            $table->string('landline_nbr',20)->nullable();
            $table->text('address')->nullable();
            $table->string('pan_no', 20)->nullable();
            $table->string('gst_no', 20)->nullable();
            $table->string('adhar_no', 20)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
