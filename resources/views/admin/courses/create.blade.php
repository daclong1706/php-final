@extends('layouts.admin')

@section('title', 'Create Course')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-8">Create Course</h1>
<form action="{{ route('admin.courses.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-gray-700 font-semibold">Name</label>
        <input type="text" name="name" id="name" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('name') border-red-400 @enderror" value="{{ old('name') }}">
        @error('name')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="category_id" class="block text-gray-700 font-semibold">Category</label>
        <select name="category_id" id="category_id" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('category_id') border-red-400 @enderror">
            <option value="">Select Category</option>
            @foreach (\App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="grade" class="block text-gray-700 font-semibold">Grade</label>
        <input type="text" name="grade" id="grade" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('grade') border-red-400 @enderror" value="{{ old('grade') }}">
        @error('grade')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="price" class="block text-gray-700 font-semibold">Price</label>
        <input type="number" step="0.01" name="price" id="price" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('price') border-red-400 @enderror" value="{{ old('price') }}">
        @error('price')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">Create</button>
</form>
@endsection