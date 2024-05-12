<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Document;
use App\Models\DocumentVersion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentUser>
 */
class DocumentUserFactory extends Factory
{
    protected array $userIds = [];
    protected array $documentIds = [];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $documentId = fake()->randomElement($this->getDocumentIds());
        return [
            'document_id'         => $documentId,
            'user_id'             => fake()->randomElement($this->getUserIds()),
            'last_viewed_version' => DocumentVersion::whereDocumentId($documentId)->first()->value('version')
        ];
    }

    private function getUserIds(): array
    {
        if (empty($this->userIds)) {
            $this->userIds = DB::table('users')
                ->where('role', UserRole::CLIENT->value)
                ->inRandomOrder()
                ->take(50)
                ->pluck('id')
                ->toArray();
        }
        return $this->userIds;
    }

    private function getDocumentIds(): array
    {
        if (empty($this->documentIds)) {
            $this->documentIds = DB::table('documents')
                ->inRandomOrder()
                ->take(50)
                ->pluck('id')
                ->toArray();
        }
        return $this->documentIds;
    }
}
