<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $admin = Admin::inRandomOrder()->first();
        return [
            "title" => $this->faker->unique()->sentence(),
            "image" => "dummy-post.jpg",
            "short_description" => $this->faker->sentences(5, true),
            "description" => $this->faker->paragraphs(20, true),
            "meta_title" => $this->faker->text(80),
            "meta_description" => $this->faker->sentences(8, true),
            "meta_keyword" => $this->faker->sentences(8, true),
            "img_alt_text" => $this->faker->text(40),
            "meta_robots_tags" => $this->faker->text(40),
            "status" => 1,
            "created_by" => $admin->id,
        ];
    }
}
