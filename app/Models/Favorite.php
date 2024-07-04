<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    protected $fillable = [
        'user_id',
        'favoritable_id',
        'favoritable_type',
        'movie_id'
    ];
    public function movies()
    {
        return $this->morphedByMany('App\Movie', 'favoritable');
    }
    public function users()
    {
        return $this->morphedByMany('App\User', 'favoritable');
    }
}
