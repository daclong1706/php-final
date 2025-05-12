<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Course::factory(20)->create([
            'video_url' => 'https://www.youtube.com/watch?v=9IUwO66wi34'
        ]); // This will create 20 fake courses
    }
}
