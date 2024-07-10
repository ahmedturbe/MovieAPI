<?php
namespace App\Filters;
class ActorFilter extends QueryFilter
{
    public function actor($actor)
    {
        return $this->builder->whereHas('actors', function ($query) use ($actor) {
            $query->where('name', $actor);
        });
    }
}
