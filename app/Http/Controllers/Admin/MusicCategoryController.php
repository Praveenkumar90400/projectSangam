<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MusicCategoryController extends Controller
{

    public function view()
    {
        $categories = Category::all();
        return view('backend.category.category',compact('categories'));
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->title = $request->input('title');
        $category->description = $request->input('description');
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function update(Request $request, $id)
{
   
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|in:0,1',
    ]);

   
    $category = Category::findOrFail($id);

    
    $category->update([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
    ]);

   
    return redirect()->back()->with('success', 'Category updated successfully!');
}


public function destroy($id)
{
    
    $category = Category::findOrFail($id);

 
    $category->delete();

    
    return redirect()->back()->with('success', 'Category deleted successfully!');
}

    
}
