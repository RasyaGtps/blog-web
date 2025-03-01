<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }

    /**
     * Get the articles for the tag.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class)
                    ->withTimestamps();
    }
} 