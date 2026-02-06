<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('candidato')->after('password');
            $table->unsignedBigInteger('empresa_id')->nullable()->after('role');

            $table->index('role');
            $table->index('empresa_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['empresa_id']);
            $table->dropColumn(['role', 'empresa_id']);
        });
    }
};
