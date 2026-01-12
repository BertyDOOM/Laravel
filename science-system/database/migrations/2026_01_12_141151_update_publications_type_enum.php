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
        \DB::statement("ALTER TABLE publications MODIFY COLUMN type ENUM(
            'journal', 'conference', 'book', 'report', 'poster', 'encyclopedia', 'monograph', 'other'
        ) DEFAULT 'journal'");
    }

    public function down(): void
    {
        \DB::statement("ALTER TABLE publications MODIFY COLUMN type ENUM(
            'journal','conference','book','report','poster'
        ) DEFAULT 'journal'");
    }

};
