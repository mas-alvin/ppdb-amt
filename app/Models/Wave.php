<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wave extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'quota',
        'status',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get all registrations for this wave.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function isOpen(): bool
    {
        return $this->status === 'open';
    }

    public function isClosed(): bool
    {
        return $this->status === 'closed';
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isFull(): bool
    {
        return $this->registrations()->count() >= $this->quota;
    }

    public function isWithinDateRange(): bool
    {
        $today = now()->startOfDay();
        return $today->greaterThanOrEqualTo($this->start_date->startOfDay()) && 
               $today->lessThanOrEqualTo($this->end_date->endOfDay());
    }
}
