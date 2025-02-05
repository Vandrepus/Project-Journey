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
            $table->foreignId('submitted_by')->nullable()->constrained('users')->onDelete('set null'); 
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location')->nullable(); 
            $table->string('category')->nullable(); 
            $table->string('opening_hours')->nullable(); 
            $table->decimal('average_rating', 2, 1)->default(0); 
            $table->string('map_url')->nullable(); 
            $table->string('photo')->nullable();
            $table->boolean('visible')->default(0); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sights');
    }
};
