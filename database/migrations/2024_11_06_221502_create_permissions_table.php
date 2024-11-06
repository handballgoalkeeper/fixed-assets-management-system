<?php

use App\Models\PermissionModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: PermissionModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name', length: 254)->unique();
            $table->string(column: 'description', length: 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: PermissionModel::TABLE);
    }
};
