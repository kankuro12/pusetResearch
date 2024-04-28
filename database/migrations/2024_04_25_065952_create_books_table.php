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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('eng_title');
            $table->string('issn');
            $table->string('doi');
            $table->string('website');
            $table->string('language_of_publication');
            $table->text('image');
            $table->text('file');
            $table->string('description');
            $table->date('issue');
            $table->date('published_date');
            $table->string('iscurrent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
