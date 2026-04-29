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
        Schema::create('waves', function (Blueprint $col) {
            $col->id();
            $col->string('name');
            $col->date('start_date');
            $col->date('end_date');
            $col->integer('quota')->default(0);
            $col->enum('status', ['draft', 'open', 'closed'])->default('draft');
            $col->text('description')->nullable();
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waves');
    }
};
