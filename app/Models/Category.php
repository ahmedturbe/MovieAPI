<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function movies(): HasMany {
        return $this->hasMany(Movie::class);
    }
}
