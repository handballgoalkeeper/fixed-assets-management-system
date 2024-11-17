<?php

use App\Models\GroupModel;
use App\Models\GroupXPermissionModel;
use App\Models\PermissionModel;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: GroupXPermissionModel::TABLE, callback: function (Blueprint $table) {
            $table->unsignedBigInteger(column: 'group_id');
            $table->unsignedBigInteger(column: 'permission_id');
            $table->unsignedBigInteger(column: 'granted_by')->nullable();
            $table->timestamp(column: 'granted_at')->useCurrent();
            $table->primary(columns: ['group_id', 'permission_id']);
            $table->foreign(columns: 'group_id')->references('id')->on(table: GroupModel::TABLE);
            $table->foreign(columns: 'permission_id')->references('id')->on(table: PermissionModel::TABLE);
            $table->foreign(columns: 'granted_by')->references('id')->on(table: User::TABLE);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: GroupXPermissionModel::TABLE);
    }
};
