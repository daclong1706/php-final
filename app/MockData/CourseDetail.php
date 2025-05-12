<?php

namespace App\MockData;

class CourseDetail
{
    public $id;
    public $name;
    public $course_id;
    public $content;
    public $description;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->course_id = $data['course_id'];
        $this->content = $data['content'];
        $this->description = $data['description'];
    }

    public static function all()
    {
        $json = file_get_contents(storage_path('app/courses.json'));
        $data = json_decode($json, true);
        return array_map(function ($item) {
            return new self($item);
        }, $data['course_details']);
    }
}
