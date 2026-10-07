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
       Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('year'); // 2026
            $table->unsignedTinyInteger('week_number'); // 1-52
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_holiday')->default(false);
            $table->string('holiday_name')->nullable(); // "Őszi szünet", "Téli szünet", stb.
            $table->text('note')->nullable();
            $table->timestamps();

            // Index a gyors lekérdezéshez
            $table->index(['year', 'week_number']);
            $table->index('start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_weeks');
    }
};
