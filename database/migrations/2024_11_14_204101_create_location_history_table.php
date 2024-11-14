<?php

use App\Models\LocationHistoryModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: LocationHistoryModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'location_id');
            $table->string(column: 'action', length: 6);
            $table->string(column: 'alias', length: 255);
            $table->string(column: 'street_name', length: 255);
            $table->string(column: 'street_number', length: 255);
            $table->string(column: 'city', length: 255);
            $table->boolean(column: 'is_active');
            $table->unsignedBigInteger(column: 'modified_by');
            $table->timestamp(column: 'timestamp')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: LocationHistoryModel::TABLE);
    }
};
