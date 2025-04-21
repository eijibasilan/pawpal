<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('vet_appointments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained();
			$table->foreignId('vet_appointment_schedule_id')->constrained();
			$table->text('details')->nullable();
			$table->enum('status', ['Pending', 'Approved', 'Cancelled'])->default('Pending');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('vet_appointments');
	}
};
