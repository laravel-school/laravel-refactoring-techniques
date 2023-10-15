<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Photo;
use App\Models\Usercity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = User::factory(1000)->create();

        foreach ($users as $user) {
            Usercity::factory()->create([
                'userid' => $user->id,
            ]);

            Photo::factory()->create([
                'userid' => $user->id,
            ]);

            echo "{$user->email} created. \n";
        }
    }
}
