<?php

use App\Models\SupplierModel;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: SupplierModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name', length: 255)->unique();
            $table->string(column: 'description', length: 255)->nullable();
            $table->string(column: 'PIB', length: 13)->nullable()->unique();
            $table->string(column: 'contact_person', length: 255)->nullable();
            $table->boolean(column: 'is_active')->default(value: true);
            $table->unsignedBigInteger(column: 'last_modified_by');
            $table->timestamps();
            $table->foreign('last_modified_by')->references('id')->on(table: User::TABLE);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: SupplierModel::TABLE);
    }
};
