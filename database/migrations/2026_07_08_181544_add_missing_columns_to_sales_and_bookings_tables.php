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
        Schema::table('sales', function (Blueprint $table) {
            if (!Schema::hasColumn('sales', 'total_pieces')) {
                $table->decimal('total_pieces', 15, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('sales', 'total_yard')) {
                $table->decimal('total_yard', 15, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('sales', 'total_meter')) {
                $table->decimal('total_meter', 15, 2)->nullable()->default(0);
            }
        });

        Schema::table('product_bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('product_bookings', 'remarks')) {
                $table->text('remarks')->nullable();
            }
            if (!Schema::hasColumn('product_bookings', 'account_id')) {
                $table->unsignedBigInteger('account_id')->nullable();
            }
            if (!Schema::hasColumn('product_bookings', 'labour_charges')) {
                $table->decimal('labour_charges', 15, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('product_bookings', 'total_pieces')) {
                $table->decimal('total_pieces', 15, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('product_bookings', 'total_yard')) {
                $table->decimal('total_yard', 15, 2)->nullable()->default(0);
            }
            if (!Schema::hasColumn('product_bookings', 'total_meter')) {
                $table->decimal('total_meter', 15, 2)->nullable()->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn(['total_pieces', 'total_yard', 'total_meter']);
        });

        Schema::table('product_bookings', function (Blueprint $table) {
            $table->dropColumn([
                'remarks', 'account_id', 'labour_charges',
                'total_pieces', 'total_yard', 'total_meter'
            ]);
        });
    }
};
