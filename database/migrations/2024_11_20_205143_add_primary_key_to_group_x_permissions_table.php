<?php

use App\Models\GroupModel;
use App\Models\GroupXPermissionModel;
use App\Models\PermissionModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(table: GroupXPermissionModel::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign('group_x_permissions_group_id_foreign');
            $table->dropForeign('group_x_permissions_permission_id_foreign');
            $table->dropPrimary();
            $table->unsignedBigInteger('id')->autoIncrement()->first();
            $table->foreign(columns: 'group_id')->references('id')->on(table: GroupModel::TABLE);
            $table->foreign(columns: 'permission_id')->references('id')->on(table: PermissionModel::TABLE);
        });
    }

    public function down(): void
    {
        Schema::table(table: GroupXPermissionModel::TABLE, callback: function (Blueprint $table) {
            $table->dropColumn('id');
            $table->primary(columns: ['group_id', 'permission_id']);
        });
    }
};
