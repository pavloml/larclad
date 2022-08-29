<ul class="category-list">
    @if($subcategories->count() > 0)
        @foreach($subcategories as $subcategory)
            <li>
                <a href="{{ route('post.search', ['city' => 'all', 'category' => $category->slug, 'subcategory' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
            </li>
        @endforeach
    @endif
</ul>
