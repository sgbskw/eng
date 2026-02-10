<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::dropIfExists('projects');
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('contract_no')->unique();
            $table->date('contract_date');
            $table->string('owner_name');
            $table->string('owner_civil_id');
            $table->json('partners')->nullable();
            $table->json('phone_numbers')->nullable();
            $table->string('area')->nullable();
            $table->string('block')->nullable();
            $table->string('parcel')->nullable();
            $table->string('paci_number')->nullable();
            $table->string('project_type')->nullable();
            $table->string('building_type')->nullable();
            $table->string('package_name')->nullable();
            $table->json('selected_services')->nullable();
            $table->boolean('free_supervision')->default(false);
            $table->json('supervision_details')->nullable();
            $table->decimal('total_contract_value', 15, 3);
            $table->json('payment_plan')->nullable();
            $table->string('land_space')->nullable();
            $table->string('land_dims')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('projects'); }
};