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
        Schema::table('registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('registrations', 'is_synced_to_datacenter')) {
                $table->boolean('is_synced_to_datacenter')->default(false);
            }
            if (!Schema::hasColumn('registrations', 'datacenter_student_id')) {
                $table->string('datacenter_student_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'is_synced_to_datacenter',
                'datacenter_student_id',
            ]);
        });
    }
};
