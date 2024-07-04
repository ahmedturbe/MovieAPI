<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;

class MovieController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 items per page if not specified
        $movies = Movie::paginate($perPage);
        return response()->json($movies, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->validated());
        $movie->actors()->attach($request->actors);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
        return response()->json($movie, 200);
    }
}
