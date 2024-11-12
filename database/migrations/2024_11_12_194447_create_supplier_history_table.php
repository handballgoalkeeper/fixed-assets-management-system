<?php

use App\Models\SupplierHistoryModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: SupplierHistoryModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'supplier_id');
            $table->string(column: 'action', length: 6);
            $table->string(column: 'name', length: 255);
            $table->string(column: 'description', length: 255)->nullable();
            $table->string(column: 'PIB', length: 13)->nullable();
            $table->string(column: 'contact_person', length: 255)->nullable();
            $table->boolean(column: 'is_active');
            $table->unsignedBigInteger(column: 'modified_by')->nullable();
            $table->timestamp(column: 'timestamp')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: SupplierHistoryModel::TABLE);
    }
};
