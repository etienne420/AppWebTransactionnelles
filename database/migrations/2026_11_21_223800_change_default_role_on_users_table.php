<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Uniformise les rôles avec User::ROLE_MEMBER et User::ROLE_MANAGER.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('member')->change();
        });

        DB::table('users')->where('role', 'joueur')->update(['role' => 'member']);
        DB::table('users')->where('role', 'admin')->update(['role' => 'manager']);
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'member')->update(['role' => 'joueur']);
        DB::table('users')->where('role', 'manager')->update(['role' => 'admin']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('joueur')->change();
        });
    }
};