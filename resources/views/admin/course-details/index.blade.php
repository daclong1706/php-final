@extends('layouts.admin')

@section('title', 'Manage Course Details')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-8">Manage Course Details</h1>

<div class="flex gap-6">
    <!-- Bên trái: Danh sách course details -->
    <div class="w-1/3 flex flex-col space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-700">Course Details List</h2>
            <a href="{{ route('admin.course-details.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                Add New Course Detail
            </a>
        </div>
        <div class="flex-1 bg-white rounded-lg shadow-md p-4 space-y-3">
            @forelse ($courseDetails as $courseDetail)
            <a href="{{ route('admin.course-details.index', ['course_detail_id' => $courseDetail->id]) }}"
                class="flex items-center p-3 rounded-lg {{ $selectedCourseDetail && $selectedCourseDetail->id == $courseDetail->id ? 'bg-blue-100 border-l-4 border-blue-500' : 'bg-gray-50' }} hover:bg-blue-100 transition-colors duration-200">
                <div class="flex-1">
                    <h3 class="font-medium text-gray-800">{{ $courseDetail->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $courseDetail->course->name }}</p>
                </div>
            </a>
            @empty
            <p class="text-gray-600">No course details found.</p>
            @endforelse
        </div>
    </div>

    <!-- Bên phải: Chi tiết và form chỉnh sửa -->
    <div class="w-2/3">
        @if ($selectedCourseDetail)
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Course Detail: {{ $selectedCourseDetail->name }}</h2>
            <div class="space-y-2">
                <p><strong>Course:</strong> {{ $selectedCourseDetail->course->name }}</p>
                <p><strong>Content:</strong> <a href="{{ $selectedCourseDetail->content }}" target="_blank" class="text-blue-500 hover:underline">{{ $selectedCourseDetail->content }}</a></p>
                <p><strong>Description:</strong> {{ $selectedCourseDetail->description }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Course Detail</h2>
            <form action="{{ route('admin.course-details.update', $selectedCourseDetail->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Name</label>
                    <input type="text" name="name" id="name" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('name') border-red-400 @enderror" value="{{ old('name', $selectedCourseDetail->name) }}">
                    @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="course_id" class="block text-gray-700 font-semibold">Course</label>
                    <select name="course_id" id="course_id" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('course_id') border-red-400 @enderror">
                        <option value="">Select Course</option>
                        @foreach (\App\Models\Course::all() as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $selectedCourseDetail->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-semibold">Content (URL)</label>
                    <input type="url" name="content" id="content" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('content') border-red-400 @enderror" value="{{ old('content', $selectedCourseDetail->content) }}">
                    @error('content')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold">Description</label>
                    <textarea name="description" id="description" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('description') border-red-400 @enderror">{{ old('description', $selectedCourseDetail->description) }}</textarea>
                    @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">Update</button>
                    <form action="{{ route('admin.course-details.destroy', $selectedCourseDetail->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-400 text-white px-4 py-2 rounded-lg hover:bg-red-500 transition-colors duration-200" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </form>
        </div>
        @else
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600">Select a course detail from the list to view and edit details.</p>
        </div>
        @endif
    </div>
</div>
@endsection