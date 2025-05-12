<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseDetail;
use Illuminate\Database\Seeder;

class CourseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        if ($courses->isEmpty()) {
            $this->call(CourseSeeder::class);
            $courses = Course::all();
        }

        $courseDetails = [
            [
                'name' => 'Giới thiệu Toán 10',
                'course_id' => $courses->where('name', 'Toán 10')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Học các khái niệm cơ bản của Toán lớp 10',
            ],
            [
                'name' => 'Cơ học Vật Lý 11',
                'course_id' => $courses->where('name', 'Vật Lý 11')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Tìm hiểu các định luật cơ học cơ bản',
            ],
            [
                'name' => 'Hóa học hữu cơ 12',
                'course_id' => $courses->where('name', 'Hóa Học 12')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Học các hợp chất hữu cơ và phản ứng hóa học',
            ],
            [
                'name' => 'Phân tích văn học 10',
                'course_id' => $courses->where('name', 'Ngữ Văn 10')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Hiểu sâu về các tác phẩm văn học Việt Nam',
            ],
            [
                'name' => 'Ngữ pháp Tiếng Anh 11',
                'course_id' => $courses->where('name', 'Tiếng Anh 11')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Nắm vững ngữ pháp và cấu trúc câu',
            ],
        ];

        foreach ($courseDetails as $detail) {
            CourseDetail::create($detail);
        }
    }
}
