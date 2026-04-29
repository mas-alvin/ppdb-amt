<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'document_path',
        'type',
        'is_active',
        'user_id', // Admin who created it
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
