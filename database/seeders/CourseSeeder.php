<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $courses = [
            [
                'name' => 'Toán 10',
                'category_id' => $categories->where('name', 'Toán')->first()->id,
                'grade' => '10',
                'price' => 99.99,
                'is_deleted' => FALSE
            ],
            [
                'name' => 'Vật Lý 11',
                'category_id' => $categories->where('name', 'Lý')->first()->id,
                'grade' => '11',
                'price' => 149.99,
                'is_deleted' => FALSE
            ],
            [
                'name' => 'Hóa Học 12',
                'category_id' => $categories->where('name', 'Hóa')->first()->id,
                'grade' => '12',
                'price' => 129.99,
                'is_deleted' => FALSE
            ],
            [
                'name' => 'Ngữ Văn 10',
                'category_id' => $categories->where('name', 'Văn')->first()->id,
                'grade' => '10',
                'price' => 89.99,
                'is_deleted' => FALSE
            ],
            [
                'name' => 'Tiếng Anh 11',
                'category_id' => $categories->where('name', 'Anh')->first()->id,
                'grade' => '11',
                'price' => 109.99,
                'is_deleted' => FALSE
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
