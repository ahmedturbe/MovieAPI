<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;
use App\Filters\CategoryFilter;
use App\Filters\ActorFilter;
use App\Filters\NameFilter;
use Tymon\JWTAuth\Facades\JWTAuth;
class MovieController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $movies = Movie::query()
            ->filter(new CategoryFilter($request))
            ->filter(new ActorFilter($request))
            ->filter(new NameFilter($request))
            ->paginate(10);
        return response()->json($movies, 200);
    }
    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $slug = Movie::generateUniqueSlug($request->name);
        $movie = Movie::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'slug' => $slug,
        ]);
        return response()->json($movie, 201);
    }
    //Update the specified resource.
    public function update(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $newSlug = Movie::generateUniqueSlug($request->name);
        if ($newSlug !== $movie->slug) {
            $request->validate([
                'slug' => 'unique:movies,slug'
            ]);
        }
        $movie->update([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $newSlug,
        ]);
        return response()->json($movie, 200);
    }
    // Display the specified resource.
    public function show($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
        return response()->json($movie, 200);
    }
    //User add movie to follow
    public function follow(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
        $user = JWTAuth::parseToken()->authenticate();
        $user->follows()->syncWithoutDetaching([$movie->id]);
        return response()->json(['message' => 'Movie followed'], 200);
    }
    //User remove movie to follow
    public function unfollow(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
        $user = JWTAuth::parseToken()->authenticate();
        $user->follows()->detach($movie->id);
        return response()->json(['message' => 'Movie unfollowed'], 200);
    }
    //User add movie to fvorite
    public function favorite(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
        $user = JWTAuth::parseToken()->authenticate();
        $user->favorites()->syncWithoutDetaching([$movie->id]);
        return response()->json(['message' => 'Movie added to favorites'], 200);
    }
    //User remove movie to favorite
    public function unfavorite(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
        $user = JWTAuth::parseToken()->authenticate();
        $user->favorites()->detach($movie->id);
        return response()->json(['message' => 'Movie removed from favorites'], 200);
    }
}
