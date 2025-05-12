<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use Illuminate\Http\Request;

class AdminCourseDetailController extends Controller
{
    public function index(Request $request)
    {
        $courseDetails = CourseDetail::with('course')->get();
        $selectedCourseDetail = null;

        if ($request->has('course_detail_id')) {
            $selectedCourseDetail = CourseDetail::with('course')->findOrFail($request->query('course_detail_id'));
        }

        return view('admin.course-details.index', compact('courseDetails', 'selectedCourseDetail'));
    }

    public function create()
    {
        return view('admin.course-details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'content' => 'required|url',
            'description' => 'required|string',
        ]);

        CourseDetail::create($request->all());
        return redirect()->route('admin.course-details.index')->with('success', 'Course Detail created successfully.');
    }

    public function update(Request $request, $id)
    {
        $courseDetail = CourseDetail::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'content' => 'required|url',
            'description' => 'required|string',
        ]);

        $courseDetail->update($request->all());
        return redirect()->route('admin.course-details.index', ['course_detail_id' => $id])->with('success', 'Course Detail updated successfully.');
    }

    public function destroy($id)
    {
        $courseDetail = CourseDetail::findOrFail($id);
        $courseDetail->delete();
        return redirect()->route('admin.course-details.index')->with('success', 'Course Detail deleted successfully.');
    }
}
