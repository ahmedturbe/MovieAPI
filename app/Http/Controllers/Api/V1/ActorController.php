<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actor;
use App\Http\Requests\StoreActorRequest;
//use Illuminate\Console\View\Components\Task;

class ActorController extends Controller
{
    // Get all actors
    public function index()
    {
        return Actor::all()->toJson();
    }
     /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActorRequest $request)
    {
        $actor = Actor::create($request->validated());
        return Actor::latest()->first();

    }

    /**
     * Display the specified resource.
     */
    public function show(Actor $actor)
    {
        return Actor::where('id', $actor->id)->with('movies')->get()->toJson(JSON_PRETTY_PRINT);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreActorRequest $request, Actor $actor)
    {
        $actor->update($request->validated());
        return "Actor updated";
    }
}
