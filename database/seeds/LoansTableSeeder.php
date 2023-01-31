<?php

use Illuminate\Database\Seeder;
use App\Loan;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Loan::create([
            'lending_id' => 2,
            'borrowed_id' => 1,
            'title' => '項目名',
            'money' => 100,
            'lending_on' => now(),
            'due_on' => 2022 . '-' . 10 . '-' . 31
        ]);

        for ($i = 1; $i <= 9; $i++) {
            Loan::create([
                'lending_id' => 1,
                'borrowed_id' => $i + 1,
                'title' => '項目名',
                'money' => 100,
                'lending_on' => now(),
                'due_on' => 2022 . '-' . 10 . '-' . 31
            ]);
        }
    }
}
