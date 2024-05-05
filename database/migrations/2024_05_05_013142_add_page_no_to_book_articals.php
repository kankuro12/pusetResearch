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
        Schema::table('book_articals', function (Blueprint $table) {
            $table->integer('st_page_no')->nullable();
            $table->integer('en_page_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_articals', function (Blueprint $table) {
            $table->dropColumn('st_page_no');
            $table->dropColumn('en_page_no');
        });
    }
};
