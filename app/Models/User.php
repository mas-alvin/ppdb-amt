<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the registration associated with the user.
     */
    public function registration()
    {
        return $this->hasOne(Registration::class);
    }

    /**
     * Get the documents uploaded by the user.
     */
    public function documents()
    {
        return $this->hasMany(StudentDocument::class);
    }

    /**
     * Calculate student registration progress.
     */
    public function calculateProgress(): int
    {
        $progress = 0;

        // 1. Registration Form (50%)
        if ($this->registration) {
            $progress += 50;
        }

        // 2. Documents (50% total, 10% each for 5 types)
        $requiredDocs = ['ijazah', 'skhun', 'kk', 'akta', 'pasfoto'];
        $uploadedDocsCount = $this->documents()
            ->whereIn('document_type', $requiredDocs)
            ->count();

        $progress += min($uploadedDocsCount * 10, 50);

        return $progress;
    }
}
