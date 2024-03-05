<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
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


    }
}
