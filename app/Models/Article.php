<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'content',
        'user_id',
        'views',
        'type'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'views' => 'integer',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * Get the user that wrote the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the article.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the likes for the article.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Get the tags for the article.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)
                    ->withTimestamps();
    }

    /**
     * Check if article is premium
     */
    public function isPremium()
    {
        return $this->type === 'premium';
    }

    public function isLikedBy(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function like(User $user): void
    {
        if (!$this->isLikedBy($user)) {
            $this->likes()->create(['user_id' => $user->id]);
        }
    }

    public function unlike(User $user): void
    {
        $this->likes()->where('user_id', $user->id)->delete();
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->setTimezone(new \DateTimeZone('Asia/Jakarta'))->format('Y-m-d H:i:s');
    }
}