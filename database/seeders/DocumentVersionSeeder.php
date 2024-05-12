<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\DocumentVersion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = Document::active()
            ->take(500)
            ->get(['id']);

        $randomDocument = $documents->random();

        DocumentVersion::factory(2500)->create([
            'document_id' => $randomDocument->id,
            'version' => function () use ($randomDocument) {
                return DocumentVersion::where('document_id', $randomDocument->id)->max('version')
                       + fake()->randomFloat(2, 1.5, 2.5);
            },
        ]);


    }
}
