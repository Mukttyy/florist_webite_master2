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
        Schema::create('usersacc', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // ✅ Sudah benar
            $table->string('password');
            $table->string('role')->default('customer'); // atau nullable jika tidak wajib
            $table->rememberToken(); // ✅ Tambahkan ini
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usersacc');
    }
};
