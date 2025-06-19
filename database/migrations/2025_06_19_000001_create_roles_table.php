<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('guard_name')->default('web');
                $table->timestamps();
            });
        } else {
            Schema::table('roles', function (Blueprint $table) {
                if (!Schema::hasColumn('roles', 'name')) {
                    $table->string('name')->unique();
                }
                if (!Schema::hasColumn('roles', 'guard_name')) {
                    $table->string('guard_name')->default('web');
                }
                // ...add other columns as needed...
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
