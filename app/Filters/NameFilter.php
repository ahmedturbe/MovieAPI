<?php
namespace App\Filters;
class NameFilter extends QueryFilter
{
    public function name($name)
    {
        return $this->builder->where('name', 'like', "%{$name}%");
    }
}
