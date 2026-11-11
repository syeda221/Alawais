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
        Schema::table('sales_returns', function (Blueprint $table) {
            if (!Schema::hasColumn('sales_returns', 'account_id')) {
                $table->unsignedBigInteger('account_id')->nullable()->after('change');
            }
            if (!Schema::hasColumn('sales_returns', 'refund_accounts')) {
                $table->text('refund_accounts')->nullable()->after('account_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_returns', function (Blueprint $table) {
            if (Schema::hasColumn('sales_returns', 'refund_accounts')) {
                $table->dropColumn('refund_accounts');
            }
            if (Schema::hasColumn('sales_returns', 'account_id')) {
                $table->dropColumn('account_id');
            }
        });
    }
};
