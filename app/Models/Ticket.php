<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'incident_date',
        'type',
        'priority',
        'status',
        'solution',
        'reported_by',
        'assigned_to',
        'attachments',
    ];

    protected $casts = [
        'incident_date' => 'datetime',
        'attachments' => 'array',
    ];

    public function reportedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
