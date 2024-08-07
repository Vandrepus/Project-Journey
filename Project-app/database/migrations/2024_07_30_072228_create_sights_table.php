<?php

// database/migrations/xxxx_xx_xx_create_sights_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSightsTable extends Migration
{
    public function up()
    {
        Schema::create('sights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location')->nullable(); // Location of the sight
            $table->string('category')->nullable(); // Category of the sight
            $table->string('opening_hours')->nullable();
            $table->decimal('average_rating', 3, 2)->default(0); // Opening hours of the sight
            $table->string('map_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sights');
    }
};
