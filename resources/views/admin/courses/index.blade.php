@extends('layouts.admin')

@section('title', 'Manage Courses')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-8">Manage Courses</h1>

<div class="flex gap-6">
    <!-- Bên trái: Danh sách courses -->
    <div class="w-1/3 flex flex-col space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-700">Courses List</h2>
            <a href="{{ route('admin.courses.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                Add New Course
            </a>
        </div>
        <div class="flex-1 bg-white rounded-lg shadow-md p-4 space-y-3">
            @forelse ($courses as $course)
            <a href="{{ route('admin.courses.index', ['course_id' => $course->id]) }}"
                class="flex items-center p-3 rounded-lg {{ $selectedCourse && $selectedCourse->id == $course->id ? 'bg-blue-100 border-l-4 border-blue-500' : 'bg-gray-50' }} hover:bg-blue-100 transition-colors duration-200">
                <div class="flex-1">
                    <h3 class="font-medium text-gray-800">{{ $course->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $course->category->name }} - Grade: {{ $course->grade }}</p>
                </div>
            </a>
            @empty
            <p class="text-gray-600">No courses found.</p>
            @endforelse
        </div>
    </div>

    <!-- Bên phải: Chi tiết và form chỉnh sửa -->
    <div class="w-2/3">
        @if ($selectedCourse)
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Course Details: {{ $selectedCourse->name }}</h2>
            <div class="space-y-2">
                <p><strong>Category:</strong> {{ $selectedCourse->category->name }}</p>
                <p><strong>Grade:</strong> {{ $selectedCourse->grade }}</p>
                <p><strong>Price:</strong> ${{ $selectedCourse->price }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Course</h2>
            <form action="{{ route('admin.courses.update', $selectedCourse->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Name</label>
                    <input type="text" name="name" id="name" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('name') border-red-400 @enderror" value="{{ old('name', $selectedCourse->name) }}">
                    @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-semibold">Category</label>
                    <select name="category_id" id="category_id" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('category_id') border-red-400 @enderror">
                        <option value="">Select Category</option>
                        @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $selectedCourse->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="grade" class="block text-gray-700 font-semibold">Grade</label>
                    <input type="text" name="grade" id="grade" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('grade') border-red-400 @enderror" value="{{ old('grade', $selectedCourse->grade) }}">
                    @error('grade')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold">Price</label>
                    <input type="number" step="0.01" name="price" id="price" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('price') border-red-400 @enderror" value="{{ old('price', $selectedCourse->price) }}">
                    @error('price')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">Update</button>
                    <form action="{{ route('admin.courses.destroy', $selectedCourse->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-400 text-white px-4 py-2 rounded-lg hover:bg-red-500 transition-colors duration-200" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </form>
        </div>
        @else
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600">Select a course from the list to view and edit details.</p>
        </div>
        @endif
    </div>
</div>
@endsection