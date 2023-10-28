<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(2000)->create();

        $faker = Faker::create();

        foreach (range(1, collect([200, 1000])->random()) as $createConversation) {
            $user1 = User::inRandomOrder()->first();
            $user2 = User::whereNot('id', $user1->id)->inRandomOrder()->first();

            $conversation = Conversation::factory()->create([
                'user_one' => $user1->id,
                'user_two' => $user2->id,
            ]);

            foreach (range(1, collect([15, 50])->random()) as $message) {
                Message::factory()->create([
                    'conversation_id' => $conversation->id,
                    'user_id' => collect([$user1->id, $user2->id])->random(),
                    'created_at' => $faker->dateTimeBetween('-2 years', now()),
                ]);
            }
        }
    }
}
