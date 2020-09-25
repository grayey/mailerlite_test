<?php

use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('currencies')->insert([
          'name' => 'USD',
          'symbol'=>'$'

      ]);
      DB::table('currencies')->insert([
          'name' => 'GBP',
          'symbol'=>'€'
      ]);
    }
}
