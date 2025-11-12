<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'id' => 1,
            'username' => 'testUser',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'avatar' => Storage::disk('public')->putFile('avatar',new File(storage_path('app/placeholders/profile_pic.png'))),
            'password' => bcrypt('password'),
        ]);

        Note::factory(100)->create([
            'user_id' => 1
        ]);
    }
}
