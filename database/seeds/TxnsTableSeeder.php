<?php

use Illuminate\Database\Seeder;

class TxnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factor(App\Txn::class,5)->create();
    }
}
