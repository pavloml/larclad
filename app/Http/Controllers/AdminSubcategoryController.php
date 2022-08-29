<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use App\Rules\CityOrCategoryNameRule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminSubcategoryController extends Controller
{

    public function create($category_id)
    {
        $category = Category::findOrFail($category_id);

        return view('admin.subcategory.create', ['title' => __('Add a category'), 'category' => $category]);
    }

    public function store(Request $request, $category_id){
        $category = Category::findOrFail($category_id);

        $validated = $request->validate(['name' =>
            ['required', 'min:2', 'max:50', new CityOrCategoryNameRule, 'unique:subcategories,name']]);

        $subcategory = new Subcategory;
        $subcategory->name = $validated['name'];
        $subcategory->slug = Str::slug($validated['name']);
        $subcategory->category_id = $category->id;

        $subcategory->save();

        return redirect(route('admin.categories'))->with('success', __('The subcategory has been successfully created'));
    }

    public function edit($id)
    {
        $subcategory = Subcategory::with('category')->findOrFail($id);

        return view('admin.subcategory.edit', ['title' => __('Edit a subcategory'), 'subcategory' => $subcategory]);
    }

    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $validated = $request->validate(['name' =>
            ['required', 'min:2', 'max:50',
                new CityOrCategoryNameRule,
                Rule::unique('subcategories', 'name')->ignore($subcategory)]]);

        $subcategory->name = $validated['name'];
        $subcategory->slug = Str::slug($validated['name']);
        $subcategory->save();

        return redirect(route('admin.categories'))->with('success', __('The subcategory has been successfully updated'));
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);

        if (Post::where('subcategory_id', $subcategory->id)->exists()) {
            return back()->with('error', __('You cannot delete a subcategory if it has any associated posts'));
        }

        $subcategory->delete();

        return back()->with('success', __('The subcategory has been successfully deleted'));
    }
}
