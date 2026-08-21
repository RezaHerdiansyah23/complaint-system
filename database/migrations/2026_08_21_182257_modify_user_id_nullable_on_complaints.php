<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $foreignKeys = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'complaints' AND CONSTRAINT_TYPE = 'FOREIGN KEY'");

        Schema::table('complaints', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });

        foreach ($foreignKeys as $fk) {
            Schema::table('complaints', function (Blueprint $table) use ($fk) {
                $table->dropForeign([$fk->CONSTRAINT_NAME]);
            });
        }

        Schema::table('complaints', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};