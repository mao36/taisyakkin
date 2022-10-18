<?php

use Illuminate\Database\Seeder;
use App\Like;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Like::create([
            'liking_id' => 2,
            'liked_id' => 1
        ]);

        for ($i = 1; $i <= 9; $i++) {
            Like::create([
                'liking_id' => 1,
                'liked_id' => $i + 1
            ]);
        }
    }
}
