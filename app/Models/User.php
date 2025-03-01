<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

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
        'membership',
        'membership_expires_at'
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
            'membership_expires_at' => 'datetime',
        ];
    }

    /**
     * Get the articles written by the user.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get the comments written by the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Role Constants
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE_VERIFIED = 'verified';

    // Membership Constants
    const MEMBERSHIP_FREE = 'free';
    const MEMBERSHIP_BASIC = 'basic';
    const MEMBERSHIP_PREMIUM = 'premium';

    // Role Checkers
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isVerified()
    {
        return $this->role === self::ROLE_VERIFIED;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }

    // Membership Checkers
    public function isFree()
    {
        return $this->membership === self::MEMBERSHIP_FREE;
    }

    public function isBasic()
    {
        return $this->membership === self::MEMBERSHIP_BASIC;
    }

    public function isPremium()
    {
        return $this->membership === self::MEMBERSHIP_PREMIUM;
    }

    public function hasMembershipExpired()
    {
        if ($this->membership === self::MEMBERSHIP_FREE) {
            return false;
        }
        
        return $this->membership_expires_at && $this->membership_expires_at->isPast();
    }

    public function updateMembership($type, $expiresAt = null)
    {
        $this->update([
            'membership' => $type,
            'membership_expires_at' => $expiresAt
        ]);
    }

    public function updateRole($role)
    {
        $this->update(['role' => $role]);
    }
}
