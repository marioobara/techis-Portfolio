<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create()->each(function($user){
            \App\Models\Item::factory(5)->create(['user_id'=>$user->id]);
        });
    }
}
