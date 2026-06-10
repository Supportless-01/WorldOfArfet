<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')
            ->where(function ($query) {
                $query->whereNull('level')
                    ->orWhere('level', 0);
            })
            ->update(['level' => 1]);

        DB::table('users')
            ->whereNull('xp')
            ->update(['xp' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration corrects user progression data and is intentionally irreversible.
    }
};
