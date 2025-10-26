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
        Schema::table('countries', function (Blueprint $table) {
            if (!Schema::hasColumn('countries', 'currency')) {
                $table->string('currency')->nullable()->after('code');
            }
            if (!Schema::hasColumn('countries', 'currency_symbol')) {
                $table->string('currency_symbol')->nullable()->after('currency');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn(['currency', 'currency_symbol']);
        });
    }
};
