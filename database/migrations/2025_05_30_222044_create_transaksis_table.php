<?php

use Database\Seeders\TransaksiSeeder;
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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->string('id_transaksi')->primary();
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('id_layanan');
            $table->string('id_admin');
            $table->integer('total_harga')->default(0);
            $table->timestamps();

            $table->foreign('id_pelanggan')
                  ->references('id')
                  ->on('pelanggans')
                  ->onDelete('cascade');

            $table->foreign('id_layanan')
                  ->references('id_layanan')
                  ->on('layanans')
                  ->onDelete('cascade');

            $table->foreign('id_admin')
                  ->references('id_admin')
                  ->on('admins')
                  ->onDelete('cascade');
        });

    }

    private function callSeeder(): void
    {
        if (app()->runningInConsole()) {
            (new TransaksiSeeder)->run();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
