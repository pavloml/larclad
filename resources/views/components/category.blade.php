<div class="card border-0">
    <div class="card-body">
        <h4>{{ $category->name }}</h4>
        <x-subcategory :subcategories="$category->subcategories" :category="$category"/>
    </div>
</div>
