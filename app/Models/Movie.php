<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function actors(): HasMany {
        return $this->hasMany(Actor::class, 'actor_movie', 'movie_id');
    }
    public function favoritedBy()
    {
        return $this->morphToMany(User::class, 'favoritable', 'favorites')->withTimestamps();
    }
    public function followedBy()
    {
        return $this->morphToMany(User::class, 'followable', 'follows')->withTimestamps();
    }
}
