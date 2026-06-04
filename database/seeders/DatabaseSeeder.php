<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Database\Factories\PostFactory;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

    /*    User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        User::factory(10)->create();
         $this->call(CategorySeeder::class);
         //$this->call(PostSeeder::class);
          Post::factory(30)->create();
 
    }
}
