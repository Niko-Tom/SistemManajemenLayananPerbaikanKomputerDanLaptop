<?php

use Database\Seeders\DetailTransaksiSeeder;
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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->string('id_detail')->primary();
            $table->string('id_transaksi');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('transaksis')
                  ->onDelete('cascade');
        });

        $this->callSeeder();
    }

    /**
     * Call the seeder if running in console.
     */
    private function callSeeder(): void
    {
        if (app()->runningInConsole()) {
            (new DetailTransaksiSeeder)->run();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
