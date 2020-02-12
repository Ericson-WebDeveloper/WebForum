<?php

use App\Thread;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ThreadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

		Thread::truncate();

		foreach(range(1,5) as $a) {
		    Thread::create([
                'subject' => $faker->name(),
                'thread' => $faker->sentence(),
                'type' => $faker->word(),
		    ]);
		}
    }
}
