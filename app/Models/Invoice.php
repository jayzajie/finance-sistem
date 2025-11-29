<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'client_name',
        'amount',
        'status',
        'due_date',
        'items',
        'created_by',
    ];

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'items' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Helper methods
    public function getFormattedAmountAttribute()
    {
        return 'Rp. ' . number_format($this->amount, 0, ',', '.');
    }
}
