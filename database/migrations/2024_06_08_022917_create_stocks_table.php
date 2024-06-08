<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('symbol');
            $table->string('longName');
            $table->string('logourl');
            $table->string('regularMarketChange');
            $table->string('regularMarketChangePercent');
            $table->string('regularMarketTime');
            $table->string('regularMarketPrice');
            $table->string('regularMarketPreviousClose');
            $table->string('regularMarketOpen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
