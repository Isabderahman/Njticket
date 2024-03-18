<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre_ticket'=>fake()->slug(),
            'contenu'=>fake()->sentences(3, true),
            'date_estime'=>fake()->dateTime(),
            'date_realisation'=>fake()->dateTime(),
        ];
    }
}
