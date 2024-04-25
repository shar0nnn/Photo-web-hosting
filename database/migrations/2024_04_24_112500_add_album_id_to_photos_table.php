<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('photos', 'album_id')) {
            Schema::table('photos', function (Blueprint $table) {
                $table->unsignedBigInteger('album_id')->nullable()->after('user_id');
                $table->foreign('album_id')->references('id')
                    ->on('albums')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('photos', function (Blueprint $table) {
//            Schema::dropIfExists('album_id');
//        });
    }
};
