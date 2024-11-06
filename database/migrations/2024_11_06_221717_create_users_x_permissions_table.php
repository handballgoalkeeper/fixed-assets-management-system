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
        Schema::create('users_x_permissions', function (Blueprint $table) {
            $table->bigIncrements(column: 'user_id');
            $table->unsignedBigInteger(column: 'permission_id');
            $table->unsignedBigInteger(column: 'permission_granted_by')->nullable();
            $table->timestamp(column: 'created_at')->useCurrent();
            $table->foreign(columns: 'permission_granted_by')->references(columns: 'id')->on(table: 'users');
            $table->foreign(columns: 'user_id')->references(columns: 'id')->on(table: 'users');
            $table->foreign(columns: 'permission_id')->references(columns: 'id')->on(table: 'permissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_x_permissions');
    }
};
