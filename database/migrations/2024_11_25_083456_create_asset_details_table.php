<?php

use App\Models\AssetDetailModel;
use App\Models\LocationModel;
use App\Models\SupplierModel as SupplierModelAlias;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: AssetDetailModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'fixed_asset_number', length: 255)->unique();
            $table->string(column: 'it_number', length: 255)->unique();
            $table->unsignedBigInteger(column: 'supplier_id')->nullable();
            $table->string(column: 'storage_type', length: 255)->nullable();
            $table->unsignedInteger(column: 'storage_capacity')->nullable();
            $table->string(column: 'storage_capacity_units_of_measure', length: 3)->nullable();
            $table->string(column: 'ram_generation', length: 6)->nullable();
            $table->unsignedInteger(column: 'ram_capacity')->nullable();
            $table->string(column: 'ram_capacity_units_of_measure', length: 6)->nullable();
            $table->boolean(column: 'is_active')->default(value: false);
            $table->timestamp(column: 'activated_at')->nullable();
            $table->boolean(column: 'is_expensed')->default(value: false);
            $table->timestamp(column: 'expensed_at')->nullable();
            $table->boolean(column: 'is_assigned')->default(value: false);
            $table->timestamp(column: 'assigned_at')->nullable();
            $table->unsignedBigInteger(column: 'assigned_to')->nullable();
            $table->unsignedBigInteger(column: 'location_id')->nullable();
            $table->unsignedBigInteger(column: 'last_modified_by')->nullable();
            $table->timestamps();

            $table->foreign(columns: 'supplier_id')->references(columns: 'id')->on(table: SupplierModelAlias::TABLE);
            $table->foreign(columns: 'assigned_to')->references(columns: 'id')->on(table: User::TABLE);
            $table->foreign(columns: 'location_id')->references(columns: 'id')->on(table: LocationModel::TABLE);
            $table->foreign(columns: 'last_modified_by')->references(columns: 'id')->on(table: User::TABLE);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: AssetDetailModel::TABLE);
    }
};
