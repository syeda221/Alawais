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

        // 2. Customer Payments (Receipts / Payments Out)
        $customerPmts = \Illuminate\Support\Facades\DB::table('customer_payments')
            ->where('account_id', $id)
            ->get()
            ->map(function ($t) {
                $isOut = isset($t->adjustment_type) && $t->adjustment_type === 'plus';
                return [
                    'date' => $t->payment_date,
                    'description' => ($isOut ? 'Customer Payment Out: ' : 'Customer Payment: ') . ($t->note ?? ($isOut ? 'Payment' : 'Receipt')),
                    'in' => $isOut ? 0 : (float) $t->amount,
                    'out' => $isOut ? (float) $t->amount : 0,
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
                    });
                }
            })
            ->where(function ($q) {
                $q->where('cash', '>', 0)->orWhere('card', '>', 0);
            })
            ->get()
            ->map(function ($t) {
                return [
                    'date' => $t->created_at,
                    'description' => 'Sale Receipt: ' . $t->invoice_no,
                    'in' => (float) ($t->cash ?? 0) + (float) ($t->card ?? 0),
                    'out' => 0,
                ];
            });

        // 5b. Sale Return Refunds (Money OUT)
        $saleReturns = \Illuminate\Support\Facades\DB::table('sales_returns')
            ->leftJoin('sales', 'sales_returns.sale_id', '=', 'sales.id')
            ->select(
                'sales_returns.id',
                'sales_returns.sale_id',
                'sales_returns.cash',
                'sales_returns.card',
                'sales_returns.account_id',
                'sales_returns.refund_accounts',
                'sales_returns.created_at',
                'sales.account_id as sale_account_id',
                'sales.invoice_no as sale_invoice_no'
            )
            ->get()
            ->flatMap(function ($sr) use ($id, $isCash) {
                $impacts = [];
                $refundAccounts = !empty($sr->refund_accounts) ? json_decode($sr->refund_accounts, true) : null;

                if (is_array($refundAccounts) && !empty($refundAccounts)) {
                    foreach ($refundAccounts as $entry) {
                        if ((int) ($entry['account_id'] ?? 0) === (int) $id && (float) ($entry['amount'] ?? 0) > 0) {
                            $impacts[] = [
                                'date' => $sr->created_at,
                                'description' => 'Sale Return Refund: RET-' . $sr->id . ($sr->sale_invoice_no ? ' (' . $sr->sale_invoice_no . ')' : ''),
                                'in' => 0,
                                'out' => (float) $entry['amount'],
                            ];
                        }
                    }
                    return $impacts;
                }

                // Legacy fallback: use sales_returns.account_id or parent sale's account_id
                $refundAmt = (float) ($sr->cash ?? 0) + (float) ($sr->card ?? 0);
                $effectiveAccountId = $sr->account_id ?: $sr->sale_account_id;
                $matchesAccount = ((int) $effectiveAccountId === (int) $id) || ($isCash && empty($effectiveAccountId));

                if ($refundAmt > 0 && $matchesAccount) {
                    $impacts[] = [
                        'date' => $sr->created_at,
                        'description' => 'Sale Return Refund: RET-' . $sr->id . ($sr->sale_invoice_no ? ' (' . $sr->sale_invoice_no . ')' : ''),
                        'in' => 0,
                        'out' => $refundAmt,
                    ];
                }

                return $impacts;
            });

        // 6. Expense Vouchers (Source Account in party_id is Money OUT)
        $expenses = \Illuminate\Support\Facades\DB::table('expense_vouchers')
            ->where('party_id', $id)
            ->where(function ($q) {
                $q->where('type', 'account')->orWhereRaw("type REGEXP '^[0-9]+$'");
            })
            ->get()
            ->map(function ($v) {
                return [
                    'date' => $v->entry_date,
                    'description' => 'Expense (' . ($v->evid ?? 'Voucher') . '): ' . ($v->remarks ?? 'Voucher'),
                    'in' => 0,
                    'out' => (float) $v->total_amount,
                ];
            });

        // 7. Receipt Vouchers
        $receiptVouchers = \Illuminate\Support\Facades\DB::table('receipts_vouchers')->get()
            ->flatMap(function ($rv) use ($id) {
                $impacts = [];
                $accIds = json_decode($rv->row_account_id, true);
                $amounts = json_decode($rv->amount, true);
                if (is_array($accIds)) {
                    foreach ($accIds as $index => $accId) {
                        if ((int) $accId === (int) $id && (float) ($amounts[$index] ?? 0) > 0) {
                            $impacts[] = [
                                'date' => $rv->receipt_date ?? $rv->entry_date ?? $rv->created_at,
                                'description' => 'Receipt Voucher (' . ($rv->rvid ?? '-') . '): ' . ($rv->remarks ?? 'Receipt'),
                                'in' => (float) $amounts[$index],
                                'out' => 0,
                            ];
                        }
                    }
                }
                if (!in_array($rv->type, ['vendor', 'customer'], true) && (int) $rv->party_id === (int) $id && (float) $rv->total_amount > 0) {
                    $impacts[] = [
                        'date' => $rv->receipt_date ?? $rv->entry_date ?? $rv->created_at,
                        'description' => 'Receipt Voucher Party (' . ($rv->rvid ?? '-') . '): ' . ($rv->remarks ?? 'Receipt'),
                        'in' => 0,
                        'out' => (float) $rv->total_amount,
                    ];
                }
                return $impacts;
            });

        // 8. Payment Vouchers
        $paymentVouchers = \Illuminate\Support\Facades\DB::table('payment_vouchers')->get()
            ->flatMap(function ($pv) use ($id) {
                $impacts = [];
                $accIds = json_decode($pv->row_account_id, true);
                $amounts = json_decode($pv->amount, true);
                if (is_array($accIds)) {
                    foreach ($accIds as $index => $accId) {
                        if ((int) $accId === (int) $id && (float) ($amounts[$index] ?? 0) > 0) {
                            $impacts[] = [
                                'date' => $pv->receipt_date ?? $pv->entry_date ?? $pv->created_at,
                                'description' => 'Payment Voucher (' . ($pv->pvid ?? '-') . '): ' . ($pv->remarks ?? 'Payment'),
                                'in' => 0,
                                'out' => (float) $amounts[$index],
                            ];
                        }
                    }
                }
                if (!in_array($pv->type, ['vendor', 'customer'], true) && (int) $pv->party_id === (int) $id && (float) $pv->total_amount > 0) {
                    $impacts[] = [
                        'date' => $pv->receipt_date ?? $pv->entry_date ?? $pv->created_at,
                        'description' => 'Payment Voucher Party (' . ($pv->pvid ?? '-') . '): ' . ($pv->remarks ?? 'Payment'),
                        'in' => (float) $pv->total_amount,
                        'out' => 0,
                    ];
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
            ->merge($saleReturns)
            ->merge($expenses)
            ->merge($receiptVouchers)
            ->merge($paymentVouchers)
            ->sort(function ($a, $b) {
                return strtotime($a['date']) <=> strtotime($b['date']);
            })
            ->values()
            ->all();

        // Keep account balance intact; compute opening balance prior to recorded transactions
        $totalIn = collect($transactions)->sum('in');
        $totalOut = collect($transactions)->sum('out');
        $ledgerClosingBalance = (float) $account->opening_balance;
        $ledgerOpeningBalance = round($ledgerClosingBalance - ($totalIn - $totalOut), 2);
        
        return view('admin_panel.reporting.account_ledger', compact('account', 'transactions', 'ledgerClosingBalance', 'ledgerOpeningBalance'));
    }
}
