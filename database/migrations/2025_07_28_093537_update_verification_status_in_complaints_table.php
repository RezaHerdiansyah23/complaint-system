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
        Schema::table('complaints', function (Blueprint $table) {
            // Hapus kolom verifikasi yang lama jika ada
            $table->dropForeign(['verified_by']);
            $table->dropColumn(['verified_at', 'verified_by']);

            // Tambahkan kolom status verifikasi yang baru
            $table->enum('verification_status', ['pending', 'accepted', 'rejected'])
                  ->default('pending')
                  ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            // Kembalikan seperti semula jika di-rollback
            $table->dropColumn('verification_status');
            $table->timestamp('verified_at')->nullable()->after('status');
            $table->foreignId('verified_by')->nullable()->after('verified_at')->constrained('users');
        });
    }
};
