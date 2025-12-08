<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('matk')->nullable()->after('password');
            $table->string('sdt', 15)->nullable()->after('matk');
            $table->string('diachi')->nullable()->after('sdt');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['matk', 'sdt', 'diachi']);
        });
    }
};
