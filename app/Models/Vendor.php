<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_person_name',
        'business_name',
        'location',
        'partnership_type',
        'other_details',
        'email',
        'phone',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Get formatted partnership type
    public function getPartnershipTypeLabel()
    {
        $labels = [
            'retail_shop' => 'Retail Shop / Dealer',
            'distributor' => 'Distributor / Wholesaler',
            'corporate_purchase' => 'Corporate Purchase',
            'real_estate' => 'Real Estate / Furnished Apartments',
            'other' => 'Other'
        ];
        return $labels[$this->partnership_type] ?? $this->partnership_type;
    }

    // Get formatted status
    public function getStatusLabel()
    {
        $labels = [
            'new' => 'New',
            'contacted' => 'Contacted',
            'in_progress' => 'In Progress',
            'approved' => 'Approved',
            'rejected' => 'Rejected'
        ];
        return $labels[$this->status] ?? $this->status;
    }

    // Get status badge color
    public function getStatusColor()
    {
        $colors = [
            'new' => 'bg-blue-100 text-blue-800',
            'contacted' => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-purple-100 text-purple-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800'
        ];
        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    // Scopes
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeContacted($query)
    {
        return $query->where('status', 'contacted');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
