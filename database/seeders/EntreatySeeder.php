<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EntreatySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        DB::table('entreaties')->insert([
            [
                'user_id' => 1,
                'reference_number' => '1111',
                'uid' => Str::random(),
                'title' => 'Contribution for Young Africans Soccer Club',
                'subtitle' =>'Money to pay players for the upcoming league',
                'description' => $faker->text(),
                'long_description' => $faker->realText(),
                'target_amount' => 3000000,
                'currency_id' => 1,
                'deadline' => '2021-07-31 23:59:00',
                'is_public' => 1,
                'is_published' => 1,
                'published_date' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
