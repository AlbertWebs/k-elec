<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'email',
        'phone'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    public function scopeContacted($query)
    {
        return $query->where('status', 'contacted');
    }

    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'unread' => 'bg-red-100 text-red-800',
            'read' => 'bg-yellow-100 text-yellow-800',
            'contacted' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
