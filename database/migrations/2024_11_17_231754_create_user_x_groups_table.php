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
        Schema::create(table: UserXGroupModel::TABLE, callback: function (Blueprint $table) {
            $table->unsignedBigInteger(column: 'user_id');
            $table->unsignedBigInteger(column: 'group_id');
            $table->unsignedBigInteger(column: 'granted_by')->nullable();
            $table->timestamp(column: 'granted_at')->useCurrent();
            $table->primary(columns: ['user_id', 'group_id']);
            $table->foreign(columns: 'user_id')->references('id')->on(User::TABLE);
            $table->foreign(columns: 'group_id')->references('id')->on(GroupModel::TABLE);
            $table->foreign(columns: 'granted_by')->references('id')->on(User::TABLE);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: UserXGroupModel::TABLE);
    }
};
