<?php

namespace App\MockData;

class Category
{
    public $id;
    public $name;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public static function all()
    {
        $json = file_get_contents(storage_path('app/courses.json'));
        $data = json_decode($json, true);
        return array_map(function ($item) {
            return new self($item);
        }, $data['categories']);
    }

    public static function find($id)
    {
        $categories = self::all();
        return collect($categories)->firstWhere('id', $id);
    }
}
