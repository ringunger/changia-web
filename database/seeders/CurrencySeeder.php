<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'name' => 'Tanzanian Shillings',
                'symbol' => 'TZS',
                'is_base' => 1
            ],
            [
                'name' => 'United States Dollar',
                'symbol' => 'USD',
                'is_base' => 0
            ],
            [
                'name' => 'Great Britain Pound',
                'symbol' => 'GBP',
                'is_base' => 0
            ],
        ]);
    }
}
