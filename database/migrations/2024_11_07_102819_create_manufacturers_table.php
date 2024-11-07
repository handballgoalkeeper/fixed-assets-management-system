<?php

use App\Models\ManufacturerModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: ManufacturerModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name', length: 255)->unique();
            $table->string(column: 'description', length: 255)->nullable();
            $table->unsignedBigInteger(column: 'created_by')->nullable();
            $table->timestamps();
            $table->foreign(columns:'created_by')->references(columns:'id')->on(table:'users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: ManufacturerModel::TABLE);
    }
};
