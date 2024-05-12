<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Document;
use App\Models\DocumentUser;
use App\Models\DocumentVersion;
use App\Models\User;
use Database\Factories\DocumentUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $singleUser = User::factory()->create(['email' => 'user@mail.com']);

        $this->call([
            AuthorSeeder::class,
            DocumentSeeder::class,
        ]);

        $this->command->info('Started seeding clients...');
        User::factory(300)->create();
        $this->command->info('Ended seeding clients...');


        $this->call([
            DocumentVersionSeeder::class,
            DocumentUserSeeder::class,
        ]);


        DocumentUser::factory(2)->create([
            'user_id' => $singleUser->id,
            'document_id' => DocumentVersion::first()->value('document_id'),
            'last_viewed_version' => DocumentVersion::first()->value('version')
        ]);

        $this->command->info('Data has been seeded successfully.');
    }
}
