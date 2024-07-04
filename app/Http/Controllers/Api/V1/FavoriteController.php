<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Movie;
use App\Http\Requests\StoreFavoriteRequest;

class FavoriteController extends Controller
{
    public function store(StoreFavoriteRequest $request) {
        $user = User::find($request->user_id);
        $movie = Movie::find($request->movie_id);
        $user->favorites()->attach($movie);
         return "Movie added as favorite";
     }
     public function destroy(StoreFavoriteRequest $request){
        $user = User::find($request->user_id);
        $movie = Movie::find($request->movie_id);
        $user->favorites()->detach($movie);
          return "Movie removed from favorites";
     }
}
