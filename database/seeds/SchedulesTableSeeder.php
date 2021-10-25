<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedule = [];

        $hour = 8;
        $minute = 30;

        for ($i = 1; $i <= 6; $i++) {

            if ($minute >= 60) {
                $hour += 1;
                $minute -= 60;
            }

            if ($hour == 13) {
                $hour += 1;
                $minute -= 15;
            }

            $cDate_time_begin = Carbon::create(2021, 10, 13, $hour, $minute);
            $cDate_time_end = Carbon::create(2021, 10, 13, $hour += 1, $minute += 20);
            $minute += 15;


            $schedule[] = [
                'date_time_begin' => $cDate_time_begin,
                'date_time_end' => $cDate_time_end,
                'group_id' => rand(1, 10),
                'teacher_id' => rand(1, 10)
            ];
        }

        DB::table('schedules')->insert($schedule);
    }
}
