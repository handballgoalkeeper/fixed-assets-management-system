<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(table: \App\Models\ManufacturerHistoryModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manufacturer_id');
            $table->string('action', 6);
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->boolean('is_active');
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamp('timestamp')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: \App\Models\ManufacturerHistoryModel::TABLE);
    }
};
