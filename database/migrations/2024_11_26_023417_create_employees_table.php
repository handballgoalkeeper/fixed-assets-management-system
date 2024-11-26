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
        Schema::create(table: EmployeeModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'first_name', length: 255);
            $table->string(column: 'last_name', length: 255);
            $table->string(column: 'email', length: 255)->unique();
            $table->boolean(column: 'is_active')->default(value: true);
            $table->unsignedBigInteger(column: 'last_modified_by')->nullable();
            $table->timestamps();

            $table->foreign(columns: 'last_modified_by')->references(columns: 'id')->on(User::TABLE);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: EmployeeModel::TABLE);
    }
};
