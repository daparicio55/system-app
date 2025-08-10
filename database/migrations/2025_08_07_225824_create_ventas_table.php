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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->foreignId('cliente_id')->constrained()->onDelete('restrict');
            $table->date('fecha')->default(now());
            $table->enum('tipo_comprobante', ['Ticket', 'Boleta', 'Factura']);
            $table->string('numero');
            $table->enum('tipo_pago', ['Efectivo','Yape', 'Plin', 'Tarjeta', 'Transferencia']);
            $table->unique(['tipo_comprobante', 'numero'], 'ventas_unique_comprobante');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
