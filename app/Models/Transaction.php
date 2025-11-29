<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'type',
        'category_id',
        'account_id',
        'transaction_date',
        'description',
        'created_by',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('transaction_date', [$startDate, $endDate]);
    }

    // Helper methods
    public function getFormattedAmountAttribute()
    {
        return 'Rp. ' . number_format($this->amount, 0, ',', '.');
    }

    // Boot method to update account balance automatically
    protected static function boot()
    {
        parent::boot();

        static::created(function ($transaction) {
            $transaction->account->updateBalance($transaction->amount, $transaction->type);
        });

        static::updated(function ($transaction) {
            // Reverse old transaction
            $original = $transaction->getOriginal();
            $oldType = $original['type'] === 'income' ? 'expense' : 'income';
            $transaction->account->updateBalance($original['amount'], $oldType);
            
            // Apply new transaction
            $transaction->account->updateBalance($transaction->amount, $transaction->type);
        });

        static::deleted(function ($transaction) {
            // Reverse the transaction
            $reverseType = $transaction->type === 'income' ? 'expense' : 'income';
            $transaction->account->updateBalance($transaction->amount, $reverseType);
        });
    }
}
