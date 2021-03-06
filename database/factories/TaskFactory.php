<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description'            => $this->faker->paragraph(),
            'maximum_execution_date' => now()->addDays(rand(1, 15)),
            'user_id'                => \App\Models\User::all()->random()->id,
            'responsible_id'         => \App\Models\User::all()->random()->id,
        ];
    }
}
