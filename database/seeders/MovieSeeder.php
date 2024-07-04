<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Actor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'category_id' => '1',
                'name' => 'Movie 1',
                'slug' => \Str::slug('Movie 1'),
                'description' => 'This is description of Movie 1'
            ],
            [
                'category_id' => '1',
                'name' => 'Movie 2',
                'slug' => \Str::slug('Movie 2'),
                'description' => 'This is description of Movie 2 in category 1'
            ],
            [
                'category_id' => '1',
                'name' => 'Movie 3',
                'slug' => \Str::slug('Movie 3'),
                'description' => 'This is description of Movie 3 and 3rd movie in category_id 1'

            ],
            [
                'category_id' => '2',
                'name' => 'Movie 4',
                'slug' => \Str::slug('Movie 4'),
                'description' => 'This is description of Movie 4'

            ],
            [
                'category_id' => '2',
                'name' => 'Movie 5',
                'slug' => \Str::slug('Movie 5'),
                'description' => 'This is description of Movie 5, second movie in category->id=2'

            ],
        ];
        Movie::insert($data);
    }
}
