<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
        ]);
        $category = new Category();
        $category->name = $request->name;   
        $category->slug = $request->slug;
        $category->save();

        

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'slug' => 'required|unique:categories,slug,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status ? 1 : 0;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
    public function updateToggle(Request $request, $categoryId)
    {
        // Retrieve the food item by ID from the database
        $category = Category::findOrFail($categoryId);

        // Update the status field with the new value
        $category->status = $request->state; // 'state' is 1 (checked) or 0 (unchecked)

        // Save the updated food item back to the database
        $category->save();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }

    
}
