<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Filters\QueryFilter;
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
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($movie) {
            $movie->slug = static::generateUniqueSlug($movie->name);
        });
        static::updating(function ($movie) {
            if ($movie->isDirty('name')) {
                $movie->slug = static::generateUniqueSlug($movie->name);
            }
        });
    }
    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        return $slug;
    }
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
    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
