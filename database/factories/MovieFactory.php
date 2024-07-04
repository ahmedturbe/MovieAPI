<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    protected $model = Movie::class;
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'name' => $title,
            'description' => $this->faker->sentence,
            'slug' => Str::slug($title),
            'category_id' => rand(1, 9),
            //'actor_id' => rand(1, 20),
        ];
    }
}
