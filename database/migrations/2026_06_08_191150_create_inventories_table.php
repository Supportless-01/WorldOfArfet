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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the user row
            $table->string('item_name');       // Name of the item (e.g., Baseball Bat)
            $table->string('item_type');       // Type: weapon, armor, medical, booster
            $table->integer('qty')->default(1); // Quantity owned
            $table->boolean('equipped')->default(false); // Is it being used in active combat?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
