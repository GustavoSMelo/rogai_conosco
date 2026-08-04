<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prayer_requests', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('whatsapp')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('prayer_requests', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
            $table->string('whatsapp')->nullable(false)->change();
        });
    }
};
