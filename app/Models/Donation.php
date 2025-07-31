<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'currency',
        'payment_method',
        'status',
        'transaction_reference',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Scope to get completed donations
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope to get pending donations
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Get total amount donated
     */
    public static function getTotalAmount()
    {
        return static::completed()->sum('amount');
    }

    /**
     * Get recent donations
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }
}
