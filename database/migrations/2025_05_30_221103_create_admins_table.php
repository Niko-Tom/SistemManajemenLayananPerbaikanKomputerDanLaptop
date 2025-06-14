<?php

use Database\Seeders\AdminSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->string('id_admin')->primary();
            $table->string('nama_admin');
            $table->string('kontak');
            $table->string('password');
            $table->enum('role', ['Admin', 'Manager', 'Staff'])->default('Staff');;
            $table->timestamps();
        });

    }

    private function callSeeder(): void
    {
        (new AdminSeeder)->run();
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
