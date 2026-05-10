<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'perfil')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('perfil')->default('usuario')->after('password');
            });
        }

        if (!Schema::hasColumn('users', 'ativo')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('ativo')->default(true)->after('perfil');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'ativo')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('ativo');
            });
        }

        if (Schema::hasColumn('users', 'perfil')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('perfil');
            });
        }
    }
};