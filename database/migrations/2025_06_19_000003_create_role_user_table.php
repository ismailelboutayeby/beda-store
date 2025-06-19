<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('role_user')) {
            Schema::create('role_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('role_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['role_id', 'user_id']);
            });
        } else {
            Schema::table('role_user', function (Blueprint $table) {
                if (!Schema::hasColumn('role_user', 'role_id')) {
                    $table->foreignId('role_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('role_user', 'user_id')) {
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                }
                // ...add other columns as needed...
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
