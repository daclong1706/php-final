@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-8">Manage Categories</h1>

<div class="flex gap-6">
    <!-- Bên trái: Danh sách categories -->
    <div class="w-1/3 flex flex-col space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-700">Categories List</h2>
            <a href="{{ route('admin.categories.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                Add New Category
            </a>
        </div>
        <div class="flex-1 bg-white rounded-lg shadow-md p-4 space-y-3">
            @forelse ($categories as $category)
            <a href="{{ route('admin.categories.index', ['category_id' => $category->id]) }}"
                class="flex items-center p-3 rounded-lg {{ $selectedCategory && $selectedCategory->id == $category->id ? 'bg-indigo-50 border-l-4 border-indigo-600' : 'bg-gray-100' }} hover:bg-indigo-50 transition-colors duration-200">
                <span class="font-medium text-gray-800">{{ $category->name }}</span>
            </a>
            @empty
            <p class="text-gray-600">No categories found.</p>
            @endforelse
        </div>
    </div>

    <!-- Bên phải: Chi tiết và form chỉnh sửa -->
    <div class="w-2/3">
        @if ($selectedCategory)
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Category Details: {{ $selectedCategory->name }}</h2>
            <p><strong>ID:</strong> {{ $selectedCategory->id }}</p>
            <p><strong>Name:</strong> {{ $selectedCategory->name }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Category</h2>
            <form action="{{ route('admin.categories.update', $selectedCategory->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Name</label>
                    <input type="text" name="name" id="name" class="w-full p-3 border rounded-lg focus:ring focus:ring-indigo-300 @error('name') border-red-500 @enderror" value="{{ old('name', $selectedCategory->name) }}">
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-200">Update</button>
                    <form action="{{ route('admin.categories.destroy', $selectedCategory->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </form>
        </div>
        @else
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600">Select a category from the list to view and edit details.</p>
        </div>
        @endif
    </div>
</div>
@endsection