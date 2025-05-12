@extends('layouts.admin')

@section('title', 'Create Course Detail')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-8">Create Course Detail</h1>
<form action="{{ route('admin.course-details.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-gray-700 font-semibold">Name</label>
        <input type="text" name="name" id="name" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('name') border-red-400 @enderror" value="{{ old('name') }}">
        @error('name')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="course_id" class="block text-gray-700 font-semibold">Course</label>
        <select name="course_id" id="course_id" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('course_id') border-red-400 @enderror">
            <option value="">Select Course</option>
            @foreach (\App\Models\Course::all() as $course)
            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
            @endforeach
        </select>
        @error('course_id')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="content" class="block text-gray-700 font-semibold">Content (URL)</label>
        <input type="url" name="content" id="content" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('content') border-red-400 @enderror" value="{{ old('content') }}">
        @error('content')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="description" class="block text-gray-700 font-semibold">Description</label>
        <textarea name="description" id="description" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
        @error('description')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">Create</button>
</form>
@endsection