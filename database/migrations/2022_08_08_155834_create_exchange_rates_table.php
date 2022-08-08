<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->char('base', 3);
            $table->char('to', 3);
            $table->unsignedDecimal('rate');
            $table->date('date');
            $table->string('exchanger', 30);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};
