<?php

use Illuminate\Database\Seeder;
use App\Belong;

class BelongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Belong::create([
            'group_id' => 2,
            'user_id' => 1
        ]);

        for ($i = 1; $i <= 9; $i++) {
            Belong::create([
                'group_id' => 1,
                'user_id' => $i + 1
            ]);
        }
    }
}
