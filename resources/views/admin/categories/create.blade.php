@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-8">Create Category</h1>
<form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-gray-700 font-semibold">Name</label>
        <input type="text" name="name" id="name" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-200 @error('name') border-red-400 @enderror" value="{{ old('name') }}">
        @error('name')
        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">Create</button>
</form>
@endsection