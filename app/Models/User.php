<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'bio',
        'role',
        'membership',
        'membership_expires_at',
        'is_admin',
        'is_verified',
        'online_status',
        'last_seen',
        'email_verified',
        'otp_code',
        'otp_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'email_verified' => 'boolean',
            'password' => 'hashed',
            'membership_expires_at' => 'datetime',
            'online_status' => 'integer',
            'last_seen' => 'datetime',
            'otp_expires_at' => 'datetime',
        ];
    }

    /**
     * Get the URL of the user's avatar
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && file_exists(public_path('avatars/' . $this->avatar))) {
            return asset('avatars/' . $this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->username);
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

    /**
     * The users that this user is following
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
            ->withTimestamps();
    }

    /**
     * The users that follow this user
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
            ->withTimestamps();
    }

    /**
     * Check if the user is following another user
     */
    public function isFollowing(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
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
        return $this->role === 'admin';
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

    public function membershipRequests()
    {
        return $this->hasMany(MembershipRequest::class);
    }

    /**
     * Get messages sent by the user
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }

    /**
     * Get messages received by the user
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }

    /**
     * Get all messages for the user (sent and received)
     */
    public function messages()
    {
        return Message::where(function($query) {
            $query->where('from_user_id', $this->id)
                  ->orWhere('to_user_id', $this->id);
        });
    }
}