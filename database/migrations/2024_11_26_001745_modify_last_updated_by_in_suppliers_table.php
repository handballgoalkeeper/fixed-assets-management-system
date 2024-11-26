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
        Schema::table(table: SupplierModel::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign('suppliers_last_modified_by_foreign');
            $table->unsignedBigInteger(column: 'last_modified_by')->nullable()->change();
            $table->foreign('last_modified_by')->references('id')->on(User::TABLE);
        });
    }

    public function down(): void
    {
        Schema::table(table: SupplierModel::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign('suppliers_last_modified_by_foreign');
            $table->unsignedBigInteger(column: 'last_modified_by')->change();
            $table->foreign('last_modified_by')->references('id')->on(User::TABLE);
        });
    }
};
