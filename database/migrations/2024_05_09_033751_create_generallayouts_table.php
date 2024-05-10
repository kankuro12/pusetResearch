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
        Schema::create('generallayouts', function (Blueprint $table) {
            $table->id();
            $table->string('copy_right_name');
            $table->date('copy_right_date');
            $table->text('short_desc');
            $table->text('long_desc');
            $table->text('logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generallayouts');
    }
};
