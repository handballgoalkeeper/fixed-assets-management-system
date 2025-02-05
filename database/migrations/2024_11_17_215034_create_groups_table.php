<?php

use App\Models\GroupModel;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: GroupModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name', length: 255)->unique();
            $table->string(column: 'description', length: 255)->nullable();
            $table->unsignedBigInteger(column: 'last_modified_by')->nullable();
            $table->timestamps();
            $table->foreign(columns: 'last_modified_by')->references(columns: 'id')->on(table: User::TABLE);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: GroupModel::TABLE);
    }
};
