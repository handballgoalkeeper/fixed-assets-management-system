<?php

use App\Models\GroupModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(table: GroupModel::TABLE, callback: function (Blueprint $table) {
            $table->boolean(column: 'is_active')->default(true)->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
