<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Post;
use App\Rules\CityOrCategoryNameRule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminCityController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['q' => new CityOrCategoryNameRule]);

        $sort['column'] = match ($request->get('sortBy')) {
            'name' => 'name',
            'slug' => 'slug',
            'created_at' => 'created_at',
            default => 'id',
        };

        $sort['direction'] = match ($request->get('sortDir')) {
            'asc' => 'ASC',
            default => 'DESC'
        };

        return view('admin.city.index', ['title' => 'cities', 'cities' => City::query()
            ->searchByName($request->get('q'))
            ->orderBy($sort['column'], $sort['direction'])
            ->paginate(20)
            ->withQueryString(),
            'sort' => $sort]);
    }

    public function create()
    {
        return view('admin.city.create', ['title' => 'Add a city']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required',
            'min:2', 'max:50',
            new CityOrCategoryNameRule, 'unique:cities,name']]);

        $city = new City;
        $city->name = $validated['name'];
        $city->slug = Str::slug($validated['name']);

        $city->save();

        return redirect(route('admin.cities'))->with('success', __('The city has been successfully created'));
    }

    public function edit(Request $request, $id)
    {
        $city = City::findOrFail($id);

        return view('admin.city.edit', ['title' => __('Edit a city'), 'city' => $city]);
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $validated = $request->validate(['name' => ['required',
            'min:2', 'max:50',
            new CityOrCategoryNameRule,
            Rule::unique('cities', 'name')->ignore($city)]]);

        $city->name = $validated['name'];
        $city->slug = Str::slug($validated['name']);

        $city->save();
        return redirect(route('admin.cities'))->with('success', __('The city has been successfully updated'));
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);

        if (Post::where('city_id', $city->id)->exists()) {
            return back()->with('error', __('You cannot delete a city if it has any associated posts'));
        }

        $city->delete();

        return back()->with('success', __('The city has been successfully deleted'));
    }
}
