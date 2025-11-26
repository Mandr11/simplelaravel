<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'subtitle' => $this->faker->sentence(6),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(3),
            'tags' => $this->faker->randomElements(['example','demo','tip','news'], 2),
            'image' => 'https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?w=1200&h=600&fit=crop',
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
