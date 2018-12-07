<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Indian Micro System',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $faker = Faker\Factory::create();

	    for($i = 0; $i < 100; $i++) {
	        App\User::create([
	            'name' => $faker->name,
		        'email' => $faker->unique()->safeEmail,
		        'email_verified_at' => now(),
		        'password' => bcrypt('secret'), // secret
		        'remember_token' => str_random(10),
	        ]);
	    }
    }
}
