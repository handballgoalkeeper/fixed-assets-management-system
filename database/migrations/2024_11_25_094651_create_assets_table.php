<?php

use App\Models\AssetDetailModel;
use App\Models\AssetModel;
use App\Models\ManufacturerModel;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: AssetModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'asset_type', length: 255);
            $table->unsignedBigInteger(column: 'manufacturer_id')->nullable();
            $table->string(column: 'asset_model', length: 255);
            $table->string(column: 'serial_number', length: 255)->nullable()->unique();
            $table->text(column: 'description')->nullable();
            $table->unsignedBigInteger(column: 'asset_details_id')->unique();
            $table->unsignedBigInteger(column: 'last_modified_by')->nullable();
            $table->timestamps();

            $table->foreign(columns: 'manufacturer_id')->references(columns: 'id')->on(table: ManufacturerModel::TABLE);
            $table->foreign(columns: 'asset_details_id')->references(columns: 'id')->on(table: AssetDetailModel::TABLE);
            $table->foreign(columns: 'last_modified_by')->references(columns: 'id')->on(table: User::TABLE);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: AssetModel::TABLE);
    }
};
