<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MockData\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = null;

        if ($request->has('category_id')) {
            $selectedCategory = Category::find($request->query('category_id'));
        }

        return view('admin.categories.index', compact('categories', 'selectedCategory'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $json = file_get_contents(storage_path('app/courses.json'));
        $jsonData = json_decode($json, true);
        $data = [
            'id' => count($jsonData['categories']) + 1,
            'name' => $request->input('name'),
        ];
        $jsonData['categories'][] = $data;
        file_put_contents(storage_path('app/courses.json'), json_encode($jsonData, JSON_PRETTY_PRINT));

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        // Không cần vì tích hợp vào index
    }

    public function edit($id)
    {
        // Không cần vì tích hợp vào index
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $json = file_get_contents(storage_path('app/courses.json'));
        $jsonData = json_decode($json, true);
        foreach ($jsonData['categories'] as &$cat) {
            if ($cat['id'] == $id) {
                $cat['name'] = $request->input('name');
                break;
            }
        }
        file_put_contents(storage_path('app/courses.json'), json_encode($jsonData, JSON_PRETTY_PRINT));

        return redirect()->route('admin.categories.index', ['category_id' => $id])->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }

        $json = file_get_contents(storage_path('app/courses.json'));
        $jsonData = json_decode($json, true);
        $jsonData['categories'] = array_filter($jsonData['categories'], function ($cat) use ($id) {
            return $cat['id'] != $id;
        });
        $jsonData['categories'] = array_values($jsonData['categories']);
        file_put_contents(storage_path('app/courses.json'), json_encode($jsonData, JSON_PRETTY_PRINT));

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
