<?php

namespace App\MockData;

class Course
{
    public $id;
    public $name;
    public $category_id;
    public $grade;
    public $price;
    public $category;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->category_id = $data['category_id'];
        $this->grade = $data['grade'];
        $this->price = $data['price'];
        $this->category = Category::find($this->category_id);
    }

    public static function all()
    {
        $json = file_get_contents(storage_path('app/courses.json'));
        $data = json_decode($json, true);
        return array_map(function ($item) {
            return new self($item);
        }, $data['courses']);
    }

    public static function find($id)
    {
        $courses = self::all();
        return collect($courses)->firstWhere('id', $id);
    }

    public static function create($data)
    {
        $json = file_get_contents(storage_path('app/courses.json'));
        $jsonData = json_decode($json, true);
        $data['id'] = count($jsonData['courses']) + 1;
        $jsonData['courses'][] = $data;
        file_put_contents(storage_path('app/courses.json'), json_encode($jsonData, JSON_PRETTY_PRINT));
        return new self($data);
    }

    public function update($data)
    {
        $json = file_get_contents(storage_path('app/courses.json'));
        $jsonData = json_decode($json, true);
        foreach ($jsonData['courses'] as &$course) {
            if ($course['id'] == $this->id) {
                $course['name'] = $data['name'];
                $course['category_id'] = $data['category_id'];
                $course['grade'] = $data['grade'];
                $course['price'] = $data['price'];
                break;
            }
        }
        file_put_contents(storage_path('app/courses.json'), json_encode($jsonData, JSON_PRETTY_PRINT));
        $this->name = $data['name'];
        $this->category_id = $data['category_id'];
        $this->grade = $data['grade'];
        $this->price = $data['price'];
        $this->category = Category::find($this->category_id);
    }

    public function delete()
    {
        $json = file_get_contents(storage_path('app/courses.json'));
        $jsonData = json_decode($json, true);
        $jsonData['courses'] = array_filter($jsonData['courses'], function ($course) {
            return $course['id'] != $this->id;
        });
        $jsonData['courses'] = array_values($jsonData['courses']);
        file_put_contents(storage_path('app/courses.json'), json_encode($jsonData, JSON_PRETTY_PRINT));
    }
}
