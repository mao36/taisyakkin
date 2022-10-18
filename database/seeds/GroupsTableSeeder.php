<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Group::create([
                'user_id' => $i,
                'title' => 'グループ' . $i
            ]);
        }
    }
}
