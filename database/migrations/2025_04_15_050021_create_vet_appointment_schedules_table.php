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
		Schema::create('vet_appointment_schedules', function (Blueprint $table) {
			$table->id();
			$table->date('scheduled_date');
			$table->time('start_time');
			$table->time('end_time')->nullable();
			$table->foreignId('vet_service_id')->constrained();
			$table->foreignId('doctor_id')->constrained('admins');
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('vet_appointment_schedules');
	}
};
