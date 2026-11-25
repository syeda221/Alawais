<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseVoucher extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'narration_id' => 'array',
        'row_account_head' => 'array',
        'row_account_id' => 'array',
        'amount' => 'array',
    ];

    /**
     * Generate auto EVID
     */
    public static function generateInvoiceNo()
    {
        $prefix = 'EVID-';
        $lastInvoice = self::orderBy('id', 'desc')->first();
        $lastNumber = 0;

        if ($lastInvoice && $lastInvoice->evid) {
            $lastNumber = (int)substr($lastInvoice->evid, strlen($prefix));
        }

        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        return $prefix . $newNumber;
    }

    /**
     * Relations
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'party_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'party_id', 'id');
    }

    public function accountHeadType()
    {
        return $this->belongsTo(AccountHead::class, 'type', 'id');
    }

    public function partyAccount()
    {
        return $this->belongsTo(Account::class, 'party_id', 'id');
    }

    /**
     * Helper Attributes
     */
    public function getPartyNameAttribute()
    {
        if ($this->type === 'account' || is_numeric($this->type)) {
            return $this->partyAccount?->title ?? 'Source Account';
        }
        if ($this->type === 'vendor') return $this->vendor?->name ?? 'N/A';
        if ($this->type === 'customer') return $this->customer?->customer_name ?? 'N/A';
        if ($this->type === 'walkin') return 'Walkin Customer';
        return 'N/A';
    }

    public function getTypeNameAttribute()
    {
        if ($this->type === 'account') return 'Account';
        if (is_numeric($this->type)) {
            return $this->accountHeadType?->name ?? 'N/A';
        }
        return ucfirst($this->type);
    }

    /**
     * Safely normalize a JSON/array-cast field to a PHP array.
     */
    public static function decodeArrayField($value): array
    {
        $attempts = 0;
        while (is_string($value) && $attempts < 3) {
            $trimmed = trim($value);
            if ($trimmed === '') {
                return [];
            }

            $decoded = json_decode($trimmed, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return [];
            }

            $value = $decoded;
            $attempts++;
        }

        return is_array($value) ? $value : [];
    }

    public function getNarrationTextAttribute()
    {
        $accIds = self::decodeArrayField($this->row_account_id);
        if (empty($accIds)) {
            return 'N/A';
        }

        return Account::whereIn('id', $accIds)->pluck('title')->implode(', ');
    }

    public function getRowTotalAmountAttribute()
    {
        $amounts = self::decodeArrayField($this->amount);
        return array_sum(array_map(static fn ($amt) => is_numeric($amt) ? (float) $amt : 0.0, $amounts));
    }

    public function getRowCountAttribute()
    {
        return count(self::decodeArrayField($this->amount));
    }

    public function getDetailsJsonAttribute()
    {
        $accIds = self::decodeArrayField($this->row_account_id);
        $amounts = self::decodeArrayField($this->amount);

        $details = [];
        foreach ($accIds as $index => $accId) {
            $category = \App\Models\ExpenseCategory::find($accId);
            $rawAmt = $amounts[$index] ?? 0;
            $details[] = [
                'category' => $category->title ?? 'Unknown',
                'amount' => is_numeric($rawAmt) ? (float) $rawAmt : 0.0,
            ];
        }
        return $details;
    }
}
