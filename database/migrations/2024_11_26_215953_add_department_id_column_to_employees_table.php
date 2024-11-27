<?php

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(table: EmployeeModel::TABLE, callback: function (Blueprint $table) {
            $table->unsignedBigInteger(column: 'department_id')->nullable()->after(column: 'email');
            $table->foreign(columns: 'department_id')->references(columns: 'id')->on(table: DepartmentModel::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(table: EmployeeModel::TABLE, callback: function (Blueprint $table) {
            $table->dropForeign(index: 'employees_department_id_foreign');
            $table->dropColumn(columns: 'id');
        });
    }
};
