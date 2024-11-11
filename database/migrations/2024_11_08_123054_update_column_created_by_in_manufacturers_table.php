<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table(table: \App\Models\ManufacturerModel::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign('manufacturers_created_by_foreign');
            $table->renameColumn('created_by', 'last_modified_by');
            $table->unsignedBigInteger('last_modified_by')->nullable()->change();
            $table->foreign('last_modified_by')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::table(table: \App\Models\ManufacturerModel::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign('manufacturers_last_modified_by_foreign');
            $table->renameColumn('last_modified_by', 'created_by');
            $table->unsignedBigInteger('created_by')->nullable(false)->change();
            $table->foreign('created_by')->references('id')->on('users');
        });
    }
};
