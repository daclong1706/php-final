<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;


class CourseController extends Controller
{
    // Course detail
    public function show($course_id): View
    {
        $course = Course::with(['category', 'coursedetails'])->notDeleted()
            ->findOrFail($course_id);

        return view('course.show', compact('course'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $selectedCategories = session()->get('selectedCategories', []);

        $courses = Course::query();

        if (!empty($query)) {
            $courses->where('name', 'LIKE', "%{$query}%");
        }

        if (!empty($selectedCategories)) {
            $courses->whereIn('category_id', $selectedCategories);
        }

        return view('components.course.course-card-list', ['courses' => $courses->get()])->render();
    }
}
