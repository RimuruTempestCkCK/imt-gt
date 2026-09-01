<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('account_type');
            $table->string('province');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('company_type')->nullable();
            $table->string('company_name');
            $table->string('pic_name');
            $table->string('phone');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_registrations');
    }
};
