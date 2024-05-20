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
        Schema::table('submissions', function (Blueprint $table) {
            $table->date('on_review_date')->nullable();
            $table->date('reviewed_date')->nullable();
            $table->date('accepted_date')->nullable();
            $table->date('rejected_date')->nullable();
            $table->date('hold_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('on_review_date');
            $table->dropColumn('reviewed_date');
            $table->dropColumn('accepted_date');
            $table->dropColumn('rejected_date');
            $table->dropColumn('hold_date');
        });
    }
};
