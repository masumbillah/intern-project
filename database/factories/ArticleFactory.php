<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>  $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'slug' =>   Str::slug($this->faker->sentence($nbWords = 6, $variableNbWords = true), '-'),
            'excerpt' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'content' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'meta_title' =>  $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'meta_description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'meta_keyword' =>  $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'category' =>  Str::slug($this->faker->sentence($nbWords = 3, $variableNbWords = true), ','),
            'image' => $this->faker->imageUrl($width = 640, $height = 480)
        ];
    }
}
