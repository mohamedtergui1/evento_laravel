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

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'organizer']);
        $userImage = ["adnan.jpg","ayman.jpg","bilal.jpg","bolbola.jpg","elaarab.jpg","elkhaili.jpg","elmorjani.jpg","ghofran.jpg","lhcen.jpg","li9ama.jpg","ossama.jpg" ,"smail.jpg","soulaiman.jpg","waheli.jpg","wissal.jpg","yassin.jpg","yassirAit.jpg" ,"zaid.jpg" ,"zehra.jpg" ];

        User::factory(20)->create()->each(function ($user) {
            $user->assignRole("user");
        });


        $faker = Faker::create();
        $categoryNames = [
            'Conferences',
            'Workshops',
            'Seminars',
            'Meetups',
            'Webinars',
            'Training',
            'Symposiums',
            'Expos',
            'Summits',
            'Festivals',
            'Networking Events',
            'Panel Discussions',
            'Hackathons',
            'Product Launches',
            'Trade Shows',
            'Career Fairs',
            'Charity Events',
            'Art Exhibitions',
            'Music Concerts',
            'Film Screenings'
        ];

        for ($x = 0; $x < count($categoryNames); $x++) {

            Category::create([
                "name" => $categoryNames[$x]
            ]);
        }

        $a = ["a.jpg","b.jpg","c.jpeg","d.jpg","e.jpg","f.png","j.webp","n.jpeg","t.webp","x.jpg","z.jpg"];
        for ($x = 0; $x < 2000; $x++) {
            Event::create([
                'title' => $faker->sentence(4),
                'image' => $a[rand(0, count($a) - 1)],
                'description' => $faker->paragraph(),
                'capacity' => $faker->numberBetween(1, 100),
                'date' => $faker->dateTimeBetween('+1 week', '+1 month'),
                'location' => $faker->address(),
                'price' => $faker->randomFloat(2, 10, 1000),
                'status' => $faker->randomElement(['accepted', 'rejected', 'pending']),
                'autoAccept' => $faker->boolean(),
                'organizer_id' => User::inRandomOrder()->first()->id,
                'category_id' => Category::inRandomOrder()->first()->id,
            ]);
        }
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt("admin"),
            "image" =>  $userImage[rand(0, count($userImage) - 1)]
        ]);
        $user->assignRole("admin");
    }


    }

