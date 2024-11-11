<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table(table: \App\Models\ManufacturerModel::TABLE, callback: function (Blueprint $table) {
            $table->boolean(column: 'is_active')->default(value: 1)->after(column: 'description');
        });
    }

    public function down(): void
    {
        Schema::table(table: \App\Models\ManufacturerModel::TABLE, callback: function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
