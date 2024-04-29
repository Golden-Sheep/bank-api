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
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payer_id');  // Coluna para o pagador
            $table->unsignedBigInteger('payee_id');  // Coluna para o beneficiário
            $table->timestamps();
            $table->foreign('payer_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('payee_id')->references('id')->on('users')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_transactions');
    }
};
