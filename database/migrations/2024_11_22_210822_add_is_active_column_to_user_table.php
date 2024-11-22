<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(table: User::TABLE, callback: function (Blueprint $table) {
            $table->unsignedBigInteger(column: 'last_modified_by')->nullable()->after(column: 'remember_token');
            $table->boolean(column: 'is_active')->default(true)->after(column: 'email');
            $table->foreign(columns: 'last_modified_by')->references('id')->on(User::TABLE);
        });
    }

    public function down(): void
    {
        Schema::table(table: User::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign('user_last_modified_by_foreign');
            $table->dropColumn(columns: 'last_modified_by');
            $table->dropColumn(columns: 'is_active');
        });
    }
};
