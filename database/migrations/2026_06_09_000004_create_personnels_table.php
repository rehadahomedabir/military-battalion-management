<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('rank_id')->constrained()->onDelete('restrict');
            $table->foreignId('trade_id')->nullable()->constrained()->onDelete('set null');
            $table->string('service_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->date('date_of_birth');
            $table->string('cnic')->unique();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->date('commission_date')->nullable();
            $table->date('joining_date');
            $table->date('retirement_date')->nullable();
            $table->enum('status', ['active', 'on_leave', 'suspended', 'retired', 'discharged'])->default('active');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->integer('children_count')->default(0);
            $table->string('next_of_kin')->nullable();
            $table->string('next_of_kin_phone')->nullable();
            $table->string('blood_group')->nullable();
            $table->jsonb('qualifications')->nullable();
            $table->jsonb('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('service_number');
            $table->index('company_id');
            $table->index('rank_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
