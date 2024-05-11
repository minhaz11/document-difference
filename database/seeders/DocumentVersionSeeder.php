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
        $documents = Document::active()->inRandomOrder()
            ->take(500)
            ->get(['id','current_version']);


        DocumentVersion::factory(2500)->create(function () use ($documents) {
            $randomDocument = $documents->random();
            return [
                'document_id' => $randomDocument->id,
                'version' => intval($randomDocument->current_version) + 1,
            ];
        });


    }
}
