<?php
namespace App\Filters;
class CategoryFilter extends QueryFilter
{
    public function category($category)
    {
        return $this->builder->whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        });
    }
}
