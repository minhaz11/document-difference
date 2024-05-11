<?php

namespace Database\Factories;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentVersion>
 */
class DocumentVersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'document_id'  => fake()->randomElement(Document::pluck('id')->toArray()),
            'version'      => fake()->randomFloat(2, 1, 2),
            'body_content' => '{\"introduction\": \"<ul><li>Federal Government\'s superannuation reforms in the 2020.\\t</li></ul>\", \"facts\": \"<ul><li>Federal Government\'s superannuation reforms in the 2020.\\t</li></ul>\", \"summary\": \"<ul><li>Federal Government\'s superannuation reforms in the 2020.\\t</li></ul>\"}',
            'tags_content' => "<ul><li>Federal Government's superannuation reforms in the 2020.\t</li></ul>",
        ];
    }
}
