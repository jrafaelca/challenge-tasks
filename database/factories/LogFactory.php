<?php

namespace Database\Factories;

use App\Models\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Log::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body'    => $this->faker->paragraph(),
            'task_id' => \App\Models\Task::all()->random()->id,
            'user_id' => \App\Models\User::all()->random()->id,
        ];
    }
}
