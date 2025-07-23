<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_pesanans_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->date('tanggal_pesan');
            $table->decimal('total_harga', 10, 2);
            $table->string('metode_pembayaran');
            $table->enum('status', ['Pending', 'Selesai', 'Dibatalkan'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
