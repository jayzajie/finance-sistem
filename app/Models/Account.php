<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name',
        'account_type',
        'balance',
        'description',
    ];

    // Relationships
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Helper methods
    public function updateBalance($amount, $type)
    {
        if ($type === 'income') {
            $this->balance += $amount;
        } else {
            $this->balance -= $amount;
        }
        $this->save();
    }

    public function getFormattedBalanceAttribute()
    {
        return 'Rp. ' . number_format($this->balance, 0, ',', '.');
    }
}
