<x-layout :title="$title">
<x-search-form />
<x-session-alerts />
            <div class="row text-center">
                <div class="col-12">
                    <h3>Categories</h3>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-4 row-cols-lg-6 justify-content-center">
                @foreach($categories as $category)
                <x-category :category="$category" />
                @endforeach
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <h3>Cities</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="region-list">
                        @foreach($cities as $city)
                            <li><a href="{{ route('post.search', ['city' => $city->slug, 'category' => 'all'])}}">{{ $city->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
</x-layout>
