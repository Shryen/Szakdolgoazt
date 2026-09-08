<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('school_class_id')
                ->references('id')
                ->on('school_classes')
                ->nullOnDelete();
        });

        Schema::table('school_classes', function (Blueprint $table) {
            $table->foreign('head_teacher_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });

        Schema::table('absences', function (Blueprint $table) {
            $table->foreign('lesson_id')
                ->references('id')
                ->on('lessons')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('absences', function (Blueprint $table) {
            $table->dropForeign(['lesson_id']);
        });

        Schema::table('school_classes', function (Blueprint $table) {
            $table->dropForeign(['head_teacher_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['school_class_id']);
        });
    }
};
