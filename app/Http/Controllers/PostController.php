<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\Subcategory;
use App\Services\ImageUploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index', ['cities' => City::orderBy('name')->get(),
            'categories' => Category::with('subcategories')
                ->orderBy('name')->get(), 'title' => config('app.name') . ' - ' . __('Classified ads')]);
    }


    public function show($id, $slug = '')
    {
        $post = Post::findOrFail($id);

        if ($post->slug !== $slug) {
            return redirect("/post/$post->id/$post->slug", 301);
        }
        return view('post.show', ['title' => $post->title,
            'post' => $post]);
    }

    public function search(Request $request, $city, $category, $subcategory = '')
    {
        $orderBy = ['column' => 'updated_at', 'direction' => 'desc'];
        $search = $request->get('q') ?? '';

        $price = null;
        $cityId = null;
        $categoryId = null;
        $subcategoryId = null;
        $priceFilterAvailable = false;

        if ($category !== 'all') {
            $fetchedCategory = Category::where('slug', $category)->firstOrFail();
            $categoryId = $fetchedCategory->id;
            $priceFilterAvailable = $fetchedCategory->price_field_available;
        }

        if ($categoryId && $subcategory !== '') {
            $subcategoryId = Subcategory::where('slug', $subcategory)->firstOrFail()->id;
        }

        if ($city !== 'all') {
            $cityId = City::where('slug', $city)->firstOrFail()->id;
        }


        if (!is_null($request->get('sortBy'))) {
            switch ($request->get('sortBy')) {
                case 'price_desc':
                    $orderBy['column'] = 'price';
                    break;
                case 'price_asc':
                    $orderBy['column'] = 'price';
                    $orderBy['direction'] = 'asc';
                    break;
                case 'date_asc':
                    $orderBy['direction'] = 'asc';
                    break;
            }
        }

        if ($priceFilterAvailable) {
            if (!is_null($request->get('min'))) {
                $price['min'] = (int)$request->get('min');
            }

            if (!is_null($request->get('max'))) {
                $price['max'] = (int)$request->get('max');
            }
        }

        return view('post.search',
            ['posts' => Post::with(['user', 'images', 'subcategory.category', 'city'])
                ->active()
                ->city($cityId)
                ->categoryOrSubcategory($categoryId, $subcategoryId)
                ->price($price)
                ->search($search)
                ->orderBy($orderBy['column'], $orderBy['direction'])
                ->paginate(20)
                ->withQueryString(),
                'title' => __('Search'),
                'city' => $city,
                'subcategory' => $subcategory,
                'priceFilterAvailable' => $priceFilterAvailable]);
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (Gate::denies('update', $post)) {
            return response('Forbidden', 403);
        }

        return view('post.edit', ['title' => __('Edit the ad'), 'post' => $post]);
    }


    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if (Gate::denies('update', $post)) {
            return response('Forbidden', 403);
        }

        $attributes = $request->safe()->except(['image']);

        if ($attributes['price'] > 0 && !Subcategory::find($attributes['subcategory_id'])->category->price_field_available) {
            $attributes['price'] = 0;
        }

        $post->update($attributes);
        $post->save();

        if ($request->has('removeImage') || $request->hasFile('image')) {
            $post->deleteImages();
        }

        if ($request->hasFile('image')) {
            try {
                $uploadedImage = new ImageUploadService($request->file('image'), $post->id);
                PostImage::create($uploadedImage->getArray());
            } catch (Exception $e) {
                $post->delete();
                Log::error('File upload error ' . $e->__toString());
                return back()->withErrors(['image' => __('File upload error')]);
            }
        }

        return redirect(route('post.show', ['id' => $post->id, 'slug' => $post->slug]))
            ->with('success', __('Post has been successfully updated'));
    }


    public function create(Request $request)
    {
        if (config('app.features.enforce_posts_limits')) {
            $userTodayPostCount = Post::belongsToUser($request->user()->id)->createdDate(now()->toDateString())->count();
            if ($userTodayPostCount >= config('app.features.user_posts_day_limit')) {
                return redirect('/')->with('error', __('You cannot create more posts today'));
            }
        }

        return view('post.create', ['title' => __('Post a new ad')]);
    }


    public function store(CreatePostRequest $request)
    {
        if (config('app.features.enforce_posts_limits')) {
            $userTodayPostCount = Post::belongsToUser($request->user()->id)->createdDate(now()->toDateString())->count();
            if ($userTodayPostCount >= config('app.features.user_posts_day_limit')) {
                return redirect('/')->with('error', __('You cannot create more posts today'));
            }
        }

        $attributes = $request->safe()->except(['image']);
        $attributes['user_id'] = $request->user()->id;

        if ($attributes['price'] > 0 && !Subcategory::find($attributes['subcategory_id'])->category->price_field_available) {
            $attributes['price'] = 0;
        }

        $post = Post::create($attributes);

        if ($request->hasFile('image')) {
            try {
                $uploadedImage = new ImageUploadService($request->file('image'), $post->id);
                PostImage::create($uploadedImage->getArray());
            } catch (Exception $e) {
                $post->delete();
                Log::error('File upload error ' . $e->__toString());
                return back()->withErrors(['image' => __('File upload error')]);
            }
        }

        return redirect(route('post.show', ['id' => $post->id, 'slug' => $post->slug]));
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (Gate::denies('delete', $post)) {
            return response('Forbidden', 403);
        }

        $post->delete();
        return redirect(route('profile.posts.active'))
            ->with('success', __('The post was successfully deleted'));
    }
}
