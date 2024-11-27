<?php

use App\Models\EmployeeModel;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(table: \App\Models\AssetDetailModel::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign(index: 'asset_details_assigned_to_foreign');
            $table->foreign(columns: 'assigned_to')->references(columns: 'id')->on(table: EmployeeModel::TABLE);
        });
    }

    public function down(): void
    {
        Schema::table(table: \App\Models\AssetDetailModel::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign(index: 'asset_details_assigned_to_foreign');
            $table->foreign(columns: 'assigned_to')->references(columns: 'id')->on(table: User::TABLE);
        });
    }
};
