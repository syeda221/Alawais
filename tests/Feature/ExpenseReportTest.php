<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\ExpenseCategory;
use App\Models\ExpenseVoucher;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class ExpenseReportTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        putenv('DB_CONNECTION=sqlite');
        putenv('DB_DATABASE=:memory:');
        $_ENV['DB_CONNECTION'] = 'sqlite';
        $_ENV['DB_DATABASE'] = ':memory:';
        $_SERVER['DB_CONNECTION'] = 'sqlite';
        $_SERVER['DB_DATABASE'] = ':memory:';

        parent::setUp();

        Config::set('database.default', 'sqlite');
        Config::set('database.connections.sqlite.database', ':memory:');
        DB::purge('sqlite');
        DB::reconnect('sqlite');

        $this->createSchema();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->user = User::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    private function createSchema(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
        });

        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');
        });

        Schema::create('account_heads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('head_id')->default(1);
            $table->string('account_code')->unique();
            $table->string('title');
            $table->string('type')->default('Debit');
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('expense_vouchers', function (Blueprint $table) {
            $table->id();
            $table->text('evid')->nullable();
            $table->text('entry_date')->nullable();
            $table->text('type')->nullable();
            $table->text('party_id')->nullable();
            $table->text('tel')->nullable();
            $table->text('remarks')->nullable();
            $table->text('narration_id')->nullable();
            $table->text('row_account_head')->nullable();
            $table->text('row_account_id')->nullable();
            $table->text('amount')->nullable();
            $table->text('total_amount')->nullable();
            $table->timestamps();
        });

        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_type')->nullable();
            $table->timestamps();
        });

        Schema::create('narrations', function (Blueprint $table) {
            $table->id();
            $table->string('expense_head')->nullable();
            $table->text('narration')->nullable();
            $table->timestamps();
        });
    }

    public function test_decode_array_field_handles_arrays_strings_double_encoded_and_null(): void
    {
        $this->assertSame(['1', '2'], ExpenseVoucher::decodeArrayField(['1', '2']));
        $this->assertSame(['1', '2'], ExpenseVoucher::decodeArrayField('["1","2"]'));
        $this->assertSame(['1', '2'], ExpenseVoucher::decodeArrayField(json_encode(json_encode(['1', '2']))));
        $this->assertSame([], ExpenseVoucher::decodeArrayField(null));
        $this->assertSame([], ExpenseVoucher::decodeArrayField(''));
        $this->assertSame([], ExpenseVoucher::decodeArrayField('invalid-json'));
    }

    public function test_expense_report_renders_with_array_cast_double_encoded_and_null_vouchers(): void
    {
        $account = Account::create([
            'head_id' => 1,
            'account_code' => 'ACC-001',
            'title' => 'Cash in Hand',
            'type' => 'Debit',
            'opening_balance' => 10000,
        ]);

        $fuelCategory = ExpenseCategory::create(['title' => 'Generator Fuel', 'total_amount' => 0]);
        $teaCategory = ExpenseCategory::create(['title' => 'Tea & Refreshments', 'total_amount' => 0]);

        $today = '2026-11-25';

        // 1. Standard single-encoded JSON (Eloquent returns PHP arrays -> previously threw TypeError)
        ExpenseVoucher::create([
            'evid' => 'EVID-001',
            'entry_date' => $today,
            'type' => 'account',
            'party_id' => $account->id,
            'remarks' => 'Edited voucher',
            'narration_id' => [],
            'row_account_head' => [1, 1],
            'row_account_id' => [(string) $fuelCategory->id, (string) $teaCategory->id],
            'amount' => [1500, 250.5],
            'total_amount' => 1750.5,
        ]);

        // 2. Legacy double-encoded JSON (Eloquent returns JSON strings)
        DB::table('expense_vouchers')->insert([
            'evid' => 'EVID-002',
            'entry_date' => $today,
            'type' => 'account',
            'party_id' => $account->id,
            'remarks' => 'Legacy double encoded',
            'narration_id' => json_encode(json_encode([])),
            'row_account_head' => json_encode(json_encode([1])),
            'row_account_id' => json_encode(json_encode([(string) $fuelCategory->id])),
            'amount' => json_encode(json_encode([500])),
            'total_amount' => '500',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Edge case: null arrays and null total_amount
        DB::table('expense_vouchers')->insert([
            'evid' => 'EVID-003',
            'entry_date' => $today,
            'type' => 'account',
            'party_id' => 9999,
            'remarks' => null,
            'narration_id' => null,
            'row_account_head' => null,
            'row_account_id' => null,
            'amount' => null,
            'total_amount' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->user)->get('/report/expense?start_date=' . $today . '&end_date=' . $today);

        $response->assertStatus(200);
        $response->assertSee('EVID-001');
        $response->assertSee('Generator Fuel: 1,500.00, Tea &amp; Refreshments: 250.50', false);
        $response->assertSee('EVID-002');
        $response->assertSee('Generator Fuel: 500.00');
        $response->assertSee('EVID-003');
        $response->assertSee('Cash in Hand');
        $response->assertSee('Rs. 2,250.50');

        $ajaxResponse = $this->actingAs($this->user)
            ->getJson('/report/expense?start_date=' . $today . '&end_date=' . $today, [
                'X-Requested-With' => 'XMLHttpRequest',
            ]);

        $ajaxResponse->assertStatus(200);
        $ajaxResponse->assertJsonCount(3);
        $ajaxResponse->assertJsonFragment([
            'evid' => 'EVID-001',
            'source_account' => 'Cash in Hand',
            'category_details' => 'Generator Fuel: 1,500.00, Tea & Refreshments: 250.50',
        ]);
    }

    public function test_storing_updating_and_printing_expense_voucher_works_with_expense_report(): void
    {
        $account = Account::create([
            'head_id' => 1,
            'account_code' => 'ACC-002',
            'title' => 'Main Cash',
            'type' => 'Debit',
            'opening_balance' => 5000,
        ]);

        $category = ExpenseCategory::create(['title' => 'Electricity Bill', 'total_amount' => 0]);

        $storeResponse = $this->actingAs($this->user)->post('/expense-vochers/store', [
            'entry_date' => '2026-11-25',
            'vendor_id' => $account->id,
            'remarks' => 'November bill',
            'row_account_id' => [$category->id],
            'amount' => [1200],
        ]);

        $storeResponse->assertRedirect();

        $rawRow = DB::table('expense_vouchers')->first();
        $this->assertNotNull($rawRow);
        $this->assertIsArray(json_decode($rawRow->row_account_id, true));

        $reportResponse = $this->actingAs($this->user)->get('/report/expense?start_date=2026-11-25&end_date=2026-11-25');
        $reportResponse->assertStatus(200);
        $reportResponse->assertSee('Electricity Bill: 1,200.00');
        $reportResponse->assertSee('Main Cash');

        $printResponse = $this->actingAs($this->user)->get('/expense-voucher/print/' . $rawRow->id);
        $printResponse->assertStatus(200);
        $printResponse->assertSee('EVID-001');

        $updateResponse = $this->actingAs($this->user)->post('/expense-voucher/update/' . $rawRow->id, [
            'entry_date' => '2026-11-25',
            'vendor_id' => $account->id,
            'remarks' => 'Updated bill',
            'row_account_id' => [$category->id],
            'amount' => [1500],
        ]);
        $updateResponse->assertRedirect();

        $updatedReportResponse = $this->actingAs($this->user)->get('/report/expense?start_date=2026-11-25&end_date=2026-11-25');
        $updatedReportResponse->assertStatus(200);
        $updatedReportResponse->assertSee('Electricity Bill: 1,500.00');
        $updatedReportResponse->assertSee('Rs. 1,500.00');

        $deleteResponse = $this->actingAs($this->user)->get('/expense-voucher/delete/' . $rawRow->id);
        $deleteResponse->assertRedirect();
        $this->assertDatabaseCount('expense_vouchers', 0);
    }
}
