<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('category')->get();
        $selectedCourse = null;

        if ($request->has('course_id')) {
            $selectedCourse = Course::with('category')->findOrFail($request->query('course_id'));
        }

        return view('admin.courses.index', compact('courses', 'selectedCourse'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'grade' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Course::create($request->all());
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'grade' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $course->update($request->all());
        return redirect()->route('admin.courses.index', ['course_id' => $course->id])->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
