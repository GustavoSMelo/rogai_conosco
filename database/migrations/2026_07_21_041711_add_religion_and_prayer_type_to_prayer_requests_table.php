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
        Schema::table('prayer_requests', function (Blueprint $table) {
            $table->string('religion', 100)->nullable()->after('whatsapp');
            $table->string('prayer_type', 50)->nullable()->after('religion');
            $table->boolean('has_answered')->default(false)->nullable(false);
            $table->date('date_answered')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prayer_requests', function (Blueprint $table) {
            $table->dropColumn(['religion', 'prayer_type']);
        });
    }
};
