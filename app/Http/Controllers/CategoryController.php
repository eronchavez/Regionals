<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    //

    public function index()
    {
        $categories = Category::all(); 
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|unique:categories,name'
        ]);

        Category::create($validated);
   
        return redirect('/categories')->with('success','Category added successfully!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }
    

     public function update(Request $req, Category $category)
    {
        $validated = $req->validate([
            'name' => 'required|unique:categories,name,' .  $category->id
        ]);

        $category->update($validated);

        return redirect('/categories')->with('success','Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        if($category->products()->count() > 0)
            {
                return redirect('/categories')->with('error', 'Cannot be deleted because it is associated with products!');
            }
            
        $category->delete();

        return redirect('/categories')->with('success', $category->name . ' successfully deleted');
    }

}
