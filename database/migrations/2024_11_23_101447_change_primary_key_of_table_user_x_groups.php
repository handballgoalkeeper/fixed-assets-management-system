<?php

use App\Models\GroupModel;
use App\Models\User;
use App\Models\UserXGroupModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(table: UserXGroupModel::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign('user_x_groups_user_id_foreign');
            $table->dropForeign('user_x_groups_group_id_foreign');
            $table->dropPrimary();
            $table->unsignedBigInteger('id')->autoIncrement()->first();
            $table->foreign(columns: 'group_id')->references('id')->on(table: GroupModel::TABLE);
            $table->foreign(columns: 'user_id')->references('id')->on(table: User::TABLE);

        });
    }

    public function down(): void
    {
        Schema::table(table: UserXGroupModel::TABLE, callback: function (Blueprint $table) {
            $table->dropColumn('id');
            $table->primary(columns: ['group_id', 'user_id']);
        });
    }
};
