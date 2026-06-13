<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'Status' => $this->status_dev(rand(0,2)),
            'Workload' => rand(1,20),
            'Work_done' => rand(1,20),
        ];
    }

    private function status_dev($rdm){
        if ($rdm <= 0){
            return "pending";
        }
        else{
            return "completed";
        }
    }
}
