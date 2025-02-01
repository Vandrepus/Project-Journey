<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('capital');
            $table->text('description')->nullable();
            $table->string('picture')->nullable();
            $table->foreignId('submitted_by')->constrained('users')->onDelete('cascade');
            $table->boolean('visible')->default(false); // Default to invisible
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
}