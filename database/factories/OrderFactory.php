<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jobs = get_order_job_types();
        $job_type = array_rand($jobs);
        return [
            'job_type' => $jobs[$job_type],
            'image_qty' => 15,
            'delivery_date' => now(),
            "image_destination" => "http://127.0.0.1:8000/",
            "status" => 1,
            "job_description" => $this->faker->sentences(10, true),
            // "created_by" => optional(User::inRandomOrder()->first())->id,
            "created_by" => User::factory(),
        ];
    }
}
