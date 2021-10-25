<?php

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupsTableSeeder::class);
        factory(Student::class, 10)->create();
        factory(Teacher::class, 10)->create();
        $this->call(SchedulesTableSeeder::class);
    }
}
