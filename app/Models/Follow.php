<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    protected $table = 'follows';
    protected $fillable = [
        'followable_id',
        'followable_type',
        'movie_id'
    ];
    public function movies()
    {
        return $this->morphedByMany('App\Movie', 'followable');
    }
    public function users()
    {
        return $this->morphedByMany('App\User', 'followable');
    }
}
