<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Rules\CityOrCategoryNameRule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.category.index', ['title' => 'categories',
            'categories' => Category::with('subcategories')->get()]);
    }

    public function create()
    {
        return view('admin.category.create', ['title' => __('Add a category')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', new CityOrCategoryNameRule,
                                        'min:2', 'max:50','unique:categories,name'],
                                        'price-field-available' => ['required', 'boolean']]);

        $category = new Category;
        $category->name = $validated['name'];
        $category->slug = Str::slug($validated['name']);
        $category->price_field_available = (bool)$validated['price-field-available'];

        $category->save();

        return redirect(route('admin.categories'))->with('success', __('The category has been successfully created'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', ['title' => __('Edit a category'), 'category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validate(['name' => ['required',
            'min:2', 'max:50',
            new CityOrCategoryNameRule,
            Rule::unique('categories', 'name')->ignore($category)],
            'price-field-available' => ['required', 'boolean']]);

        $category->name = $validated['name'];
        $category->slug = Str::slug($validated['name']);
        $category->price_field_available = (bool)$validated['price-field-available'];

        $category->save();
        return redirect(route('admin.categories'))->with('success', __('The category has been successfully updated'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if (Subcategory::where('category_id', $category->id)->exists()) {
            return back()->with('error', __('You cannot delete a category if it has any associated subcategories'));
        }

        $category->delete();

        return back()->with('success', __('The category has been successfully deleted'));
    }
}
