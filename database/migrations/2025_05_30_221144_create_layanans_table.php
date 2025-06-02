<?php

use Database\Seeders\LayananSeeder;
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
        Schema::create('layanans', function (Blueprint $table) {
            $table->string('id_layanan')->primary();
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('jenis_kerusakan');
            $table->date('tanggal_masuk');
            $table->text('catatan')->nullable();
            $table->integer('harga')->default(0);
            $table->timestamps();

            $table->foreign('id_pelanggan')
                  ->references('id')
                  ->on('pelanggans')
                  ->onDelete('cascade');
        });

        $this->callSeeder();
    }

    private function callSeeder(): void
    {
        if (app()->runningInConsole()) {
            (new LayananSeeder)->run();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
