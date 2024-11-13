<?php

use App\Models\LocationModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(table: LocationModel::TABLE, callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'alias', length: 255)->unique();
            $table->string(column: 'street_name', length: 255);
            $table->string(column: 'street_number', length: 5);
            $table->string(column: 'city', length: 255);
            $table->boolean(column: 'is_active')->default(true);
            $table->unsignedBigInteger(column:'last_modified_by')->nullable();
            $table->timestamps();
            $table->foreign('last_modified_by')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: LocationModel::TABLE);
    }
};
