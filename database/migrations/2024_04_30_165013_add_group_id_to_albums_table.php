<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('albums', 'group_id')) {
            Schema::table('albums', function (Blueprint $table) {
                $table->unsignedBigInteger('group_id')->after('user_id')->nullable();
                $table->foreign('group_id')->references('id')
                    ->on('groups')->onDelete('set null');
            });
        }

        if (!Schema::hasColumn('albums', 'group_name')) {
            Schema::table('albums', function (Blueprint $table) {
                $table->string('group_name')->after('name')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            //
        });
    }
};
