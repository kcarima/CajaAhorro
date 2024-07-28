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
        Schema::connection(name: 'seguridad')->create(table: 'users', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'cedula', length: 11)->unique();
            $table->enum(column: 'tipo', allowed: ['ROOT', 'ADMINISTRADOR', 'ASOCIADO'])->default(value: 'ASOCIADO');
            $table->enum(column: 'status', allowed: ['SUSPENDIDO', 'ACTIVO', 'INACTIVO', 'ELIMINADO', 'FALLECIDO'])->default(value: 'ACTIVO');
            $table->enum(column: 'status_password', allowed: ['CAMBIAR', 'VALIDO', 'BLOQUEADO'])->default(value: 'CAMBIAR')->comment(comment: 'Establece la situacion de la contraseña, cambiar se refiere a que debe cambiarse al iniciar sesion, mientras que valido no requiere ninguna accion');
            $table->string(column: 'email')->nullable();
            $table->string(column: 'password')->nullable();
            $table->timestamp(column: 'last_login')->nullable();
            $table->ipAddress(column: 'last_login_ip')->nullable();
            $table->date(column: 'fecha_fin_suspension')->nullable();
            $table->string(column: 'profile_photo_path', length: 2048)->nullable();
            $table->timestamp(column: 'email_verified_at')->nullable();
            $table->unsignedTinyInteger('intentos_login')->default(0);
            $table->timestamp('fecha_intentos_login')->nullable();
            $table->uuid()->unique();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(columns: 'cedula')->references(columns: 'cedula')->on(table: 'sca.socios')->onDelete(action: 'cascade')->onUpdate(action: 'cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'seguridad')->dropIfExists(table: 'users');
    }
};
