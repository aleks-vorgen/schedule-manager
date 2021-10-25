<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [];

        for($i = 1; $i <= 10; $i++) {
            $cTitle = "Группа №".$i;

            $groups[] = [
                'title' => $cTitle
            ];
        }

        DB::table('groups')->insert($groups);
    }
}
