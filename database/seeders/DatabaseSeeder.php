<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Event;


use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(20)->create();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'organizer']);
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt("admin")
        ]);
        $user->assignRole("admin");


        $faker = Faker::create();

        for ($x = 0; $x < 10; $x++) {
            $name = $faker->unique()->word;
            Category::create([
                "name" => $name,
            ]);
        }
        $a = ["a.jpg","b.jpg","c.jpeg","d.jpg","e.jpg","f.png","j.webp","n.jpeg","t.webp","x.jpg","z.jpg"];
        for ($x = 0; $x < 1000; $x++) {
            Event::create([
                'title' => $faker->sentence(4),
                'image' => $a[rand(0, count($a) - 1)],
                'description' => $faker->paragraph(),
                'capacity' => $faker->numberBetween(1, 100),
                'rest_places' => $faker->numberBetween(1, 100),
                'date' => $faker->dateTimeBetween('+1 week', '+1 month'),
                'location' => $faker->address(),
                'price' => $faker->randomFloat(2, 10, 1000),
                'status' => $faker->randomElement(['accepted', 'rejected', 'pending']),
                'autoAccept' => $faker->boolean(),
                'organizer_id' => User::inRandomOrder()->first()->id,
                'category_id' => Category::inRandomOrder()->first()->id,  
            ]);
        }
    }


    }

