<x-layout :title="$title">
    <x-search-form :city="$city" :subcategory="$subcategory"/>
    <div class="row justify-content-center p-2">
        <div class="col-6 col-md-3">
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" aria-label="Sort by" id="sort_by"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    @switch(request('sortBy'))
                        @case('price_desc')
                            Price: high to low
                            @break
                        @case('price_asc')
                            Price: low to high
                            @break
                        @case('date_asc')
                            Date: older first
                            @break
                        @case('date_desc')
                        @default
                            Date: newer first
                    @endswitch
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="sort_by">
                    <li><a href="{{ request()->fullUrlWithQuery(['sortBy' => 'date_desc']) }}">Date: newer first</a>
                    </li>
                    <li><a href="{{ request()->fullUrlWithQuery(['sortBy' => 'date_asc']) }}">Date: older first</a></li>
                    <li><a href="{{ request()->fullUrlWithQuery(['sortBy' => 'price_asc']) }}">Price: low to high</a>
                    </li>
                    <li><a href="{{ request()->fullUrlWithQuery(['sortBy' => 'price_desc']) }}">Price: high to low</a>
                    </li>
                </ul>
            </div>
        </div>
        @if($priceFilterAvailable)
            <div class="col-8">
                <form class="form-inline price-range">
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    <input type="hidden" name="sortBy" value="{{ request('sortBy') }}">
                    <div class="form-group mb-2 mr-sm-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="min-price">From $</label>
                            </div>
                            <input type="number" name="min" id="min-price" class="form-control" min="0" step="0.01"
                                   value="{{ request('min')  }}">
                        </div>
                    </div>
                    <div class="form-group mb-2 mr-sm-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="max-price">To $</label>
                            </div>
                            <input type="number" name="max" id="max-price" class="form-control" min="0" step="0.01"
                                   value="{{ request('max')  }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info mb-2 mr-sm-2">Update</button>
                </form>
            </div>
        @endif
    </div>

    <section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
        @foreach($posts as $post)
            <article class="col mb-4 post-in-search">
                <div class="card border h-100">
                    @if(!$post->images->isEmpty())
                        <x-post-thumbnail src="{{ asset($post->getMainImage()->thumbnail_path) }}"/>
                    @else
                        <x-post-thumbnail/>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ url("/post/$post->id/$post->slug") }}">{{ $post->title }}</a>
                        </h5>
                        <div class="card-text">
                            @if($post->subcategory->category->price_field_available)
                                <p class="h4">
                                    <span class="info">{{ $post->price ? '$ ' . $post->price : 'Free' }}</span>
                                </p>
                            @endif
                        </div>
                        <small>{{ $post->city->name }}</small>
                    </div>
                    <div class="card-footer">
                        <small>{{ $post->subcategory->name }}</small>
                        <small>
                            <x-time :time="$post->updated_at" diff_for_humans="true"/>
                        </small>
                    </div>

                </div>
            </article>
        @endforeach
    </section>
    {{ $posts->onEachSide(0)->links() }}
</x-layout>
