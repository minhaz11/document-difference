<?php

namespace Database\Factories;

use App\Enums\DocumentStatus;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $authorIds = DB::table('users')
            ->where('role', UserRole::AUTHOR->value)
            ->pluck('id')
            ->toArray();

        return [
            'author_id' => fake()->randomElement($authorIds),
            'current_version' => fake()->randomFloat(2, 1, 2),
            'title'   => fake()->sentence,
            'status'  => fake()->randomElement(DocumentStatus::values()),
        ];
    }
}
