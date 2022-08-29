<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Post;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->realText(70);
        $subcategory = Subcategory::inRandomOrder()->limit(1)->first();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->realTextBetween(10, 1000),
            'price' => $subcategory->category->price_field_available ? $this->faker->numberBetween(0, 10000000) : 0,
            'city_id' => City::inRandomOrder()->limit(1)->first()->id,
            'user_id' => User::inRandomOrder()->limit(1)->first()->id,
            'subcategory_id' => $subcategory->id,
            'active' => true,
        ];
    }
}
