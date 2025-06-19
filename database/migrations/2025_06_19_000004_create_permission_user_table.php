<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('permission_user')) {
            Schema::create('permission_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('permission_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                $table->unique(['permission_id', 'user_id']);
            });
        } else {
            Schema::table('permission_user', function (Blueprint $table) {
                if (!Schema::hasColumn('permission_user', 'permission_id')) {
                    $table->foreignId('permission_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('permission_user', 'user_id')) {
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                }
                // ...add other columns as needed...
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_user');
    }
};
