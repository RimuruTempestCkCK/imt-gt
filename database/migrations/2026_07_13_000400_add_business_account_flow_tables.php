<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('account_type')->nullable()->after('username');
            $table->string('province')->nullable()->after('account_type');
        });

        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('company_prefix')->nullable();
            $table->string('company_name')->nullable();
            $table->unsignedSmallInteger('year_of_establishment')->nullable();
            $table->string('main_product')->nullable();
            $table->text('company_description')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('scale_of_business')->nullable();
            $table->string('scale_of_business_detail')->nullable();
            $table->string('incoterm')->nullable();
            $table->string('terms_of_payment')->nullable();
            $table->unsignedInteger('employee_count')->nullable();
            $table->string('website')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_phone', 50)->nullable();
            $table->string('type_of_business')->nullable();
            $table->string('type_of_business_detail')->nullable();
            $table->string('google_maps_link')->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->string('logo_path')->nullable();
            $table->string('npwp_number', 32)->nullable();
            $table->string('npwp_document_path')->nullable();
            $table->string('nib_number', 64)->nullable();
            $table->string('nib_document_path')->nullable();
            $table->timestamp('profile_completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('company_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_profile_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('position')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email')->nullable();
            $table->unsignedInteger('sort_order')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_contacts');
        Schema::dropIfExists('company_profiles');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['account_type', 'province']);
        });
    }
};
