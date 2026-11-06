<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountHead;
use Illuminate\Http\Request;

class AccountsHeadController extends Controller
{
    public function index()
    {
        $accounts = Account::with('head')->get();
        // dd( $accounts->toArray());
        $heads = AccountHead::all();
        return view('admin_panel.chart_of_accounts', compact('accounts', 'heads'));
    }
    public function storeHead(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        AccountHead::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Head added successfully.');
    }

    public function updateHead(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:100']);
        $head = AccountHead::findOrFail($id);
        $head->update(['name' => $request->name]);
        return redirect()->back()->with('success', 'Head updated successfully.');
    }

    public function destroyHead($id)
    {
        $head = AccountHead::findOrFail($id);
        if ($head->accounts()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete Head as it has associated accounts.');
        }
        $head->delete();
        return redirect()->back()->with('success', 'Head deleted successfully.');
    }

    public function storeAccount(Request $request)
    {
        $request->validate([
            'head_id'        => 'required|exists:account_heads,id',
            'account_code'   => 'required|unique:accounts,account_code',
            'title'          => 'required|string|max:150',
            'type'           => 'required|in:Debit,Credit',
            'opening_balance' => 'nullable|numeric',
            'status'         => 'nullable|in:on',
        ]);

        // Set status (1 = active, 0 = inactive)
        $status = $request->status === 'on' ? 1 : 0;

        Account::create([
            'head_id'         => $request->head_id,
            'account_code'    => $request->account_code,
            'title'           => $request->title,
            'type'            => $request->type,
            'opening_balance' => $request->opening_balance ?? 0,
            'status'          => $status,
        ]);

        return redirect()->back()->with('success', 'Account added successfully.');
    }

    public function updateAccount(Request $request, $id)
    {
        $request->validate([
            'head_id'        => 'required|exists:account_heads,id',
            'account_code'   => 'required|unique:accounts,account_code,' . $id,
            'title'          => 'required|string|max:150',
            'type'           => 'required|in:Debit,Credit',
            'opening_balance' => 'nullable|numeric',
            'status'         => 'nullable|in:on',
        ]);

        $account = Account::findOrFail($id);
        $status = $request->status === 'on' ? 1 : 0;

        $account->update([
            'head_id'         => $request->head_id,
            'account_code'    => $request->account_code,
            'title'           => $request->title,
            'type'            => $request->type,
            'opening_balance' => $request->opening_balance ?? 0,
            'status'          => $status,
        ]);

        return redirect()->back()->with('success', 'Account updated successfully.');
    }

    public function destroyAccount($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();
        return redirect()->back()->with('success', 'Account deleted successfully.');
    }

    public function accountLedger($id)
    {
        $account = Account::findOrFail($id);
        
        // 1. Other Incomes (Receipts)
        $incomes = \Illuminate\Support\Facades\DB::table('other_incomes')
            ->where('account_id', $id)
            ->get()
            ->map(function ($t) {
                return [
                    'date' => $t->date,
                    'description' => 'Other Income: ' . $t->title,
                    'in' => (float) $t->amount,
                    'out' => 0,
                ];
            });

        // 2. Customer Payments (Receipts)
        $customerPmts = \Illuminate\Support\Facades\DB::table('customer_payments')
            ->where('account_id', $id)
            ->get()
            ->map(function ($t) {
                return [
                    'date' => $t->payment_date,
                    'description' => 'Customer Payment: ' . ($t->note ?? 'Receipt'),
                    'in' => (float) $t->amount,
                    'out' => 0,
                ];
            });

        // 3. Vendor Payments (Payments)
        $vendorPmts = \Illuminate\Support\Facades\DB::table('vendor_payments')
            ->where('account_id', $id)
            ->get()
            ->map(function ($t) {
                // adjustment_type 'plus' means Receipt from Vendor, 'minus' means Payment Out
                $isPlus = isset($t->adjustment_type) && $t->adjustment_type === 'plus';
                return [
                    'date' => $t->payment_date,
                    'description' => 'Vendor Payment: ' . ($t->note ?? ''),
                    'in' => $isPlus ? (float)$t->amount : 0,
                    'out' => $isPlus ? 0 : (float)$t->amount,
                ];
            });

        // 4. Account Transfers
        $transfersFrom = \Illuminate\Support\Facades\DB::table('account_transfers')
            ->where('from_account_id', $id)
            ->get()
            ->map(function ($t) {
                return [
                    'date' => $t->transfer_date,
                    'description' => 'Transfer To: ' . (\App\Models\Account::find($t->to_account_id)->title ?? 'Unknown'),
                    'in' => 0,
                    'out' => (float) $t->amount,
                ];
            });

        $transfersTo = \Illuminate\Support\Facades\DB::table('account_transfers')
            ->where('to_account_id', $id)
            ->get()
            ->map(function ($t) {
                return [
                    'date' => $t->transfer_date,
                    'description' => 'Transfer From: ' . (\App\Models\Account::find($t->from_account_id)->title ?? 'Unknown'),
                    'in' => (float) $t->amount,
                    'out' => 0,
                ];
            });

        // 5. Sales (Cash Receipts)
        $isCash = \App\Models\Account::where('id', $id)
            ->where(function($q) {
                $q->where('id', 1)->orWhere('title', 'like', '%cash%');
            })->exists();

        $sales = \Illuminate\Support\Facades\DB::table('sales')
            ->where(function ($q) use ($id, $isCash) {
                $q->where('account_id', $id);
                if ($isCash) {
                    $q->orWhere(function ($sq) {
                        $sq->whereNull('account_id')->orWhere('account_id', 0)->orWhere('account_id', '');
                    })->where('cash', '>', 0);
                }
            })
            ->where('cash', '>', 0)
            ->get()
            ->map(function ($t) {
                return [
                    'date' => $t->created_at,
                    'description' => 'Sale Receipt: ' . $t->invoice_no,
                    'in' => (float) $t->cash,
                    'out' => 0,
                ];
            });

        // 6. Expense Vouchers (JSON Parsing)
        $expenses = \Illuminate\Support\Facades\DB::table('expense_vouchers')->get()
            ->flatMap(function ($v) use ($id) {
                $decoded = json_decode($v->row_account_id, true);
                $accIds = is_array($decoded) ? $decoded : [];
                $decodedAmts = json_decode($v->amount, true);
                $amounts = is_array($decodedAmts) ? $decodedAmts : [];
                $impacts = [];

                foreach ($accIds as $index => $accId) {
                    if ($accId == $id) {
                        $impacts[] = [
                            'date' => $v->entry_date,
                            'description' => 'Expense: ' . ($v->remarks ?? 'Voucher'),
                            'in' => 0,
                            'out' => (float) ($amounts[$index] ?? 0),
                        ];
                    }
                }
                return $impacts;
            });

        // Merge and Sort
        $transactions = $incomes
            ->merge($customerPmts)
            ->merge($vendorPmts)
            ->merge($transfersFrom)
            ->merge($transfersTo)
            ->merge($sales)
            ->merge($expenses)
            ->sortBy('date')
            ->values()
            ->all();

        // Calculate dynamic ledger balance
        $totalIn = collect($transactions)->sum('in');
        $totalOut = collect($transactions)->sum('out');
        $ledgerClosingBalance = $totalIn - $totalOut;

        // Keep account balance synced with actual ledger total
        if ((float) $account->opening_balance !== (float) $ledgerClosingBalance) {
            $account->opening_balance = $ledgerClosingBalance;
            $account->save();
        }
        
        return view('admin_panel.reporting.account_ledger', compact('account', 'transactions', 'ledgerClosingBalance'));
    }
}
