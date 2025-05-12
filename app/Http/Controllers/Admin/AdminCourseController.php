<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MockData\Course;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();
        $selectedCourse = null;

        if ($request->has('course_id')) {
            $selectedCourse = Course::find($request->query('course_id'));
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
            'category_id' => 'required|integer|exists:App\MockData\Category,id',
            'grade' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Course::create($request->all());
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function show($id)
    {
        // Không cần vì đã tích hợp vào index
    }

    public function edit($id)
    {
        // Không cần vì đã tích hợp vào index
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:App\MockData\Category,id',
            'grade' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $course->update($request->all());
        return redirect()->route('admin.courses.index', ['course_id' => $course->id])->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }

        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
