<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'party_name',
        'due_date',
        'status',
        'description',
        'created_by',
    ];

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeDebts($query)
    {
        return $query->where('type', 'debt');
    }

    public function scopeReceivables($query)
    {
        return $query->where('type', 'receivable');
    }

    // Helper methods
    public function getFormattedAmountAttribute()
    {
        return 'Rp. ' . number_format($this->amount, 0, ',', '.');
    }
}
