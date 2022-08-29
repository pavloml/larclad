@props(['selectedSubcategory' => ''])
<select {{  $attributes->merge(['class' => 'form-control selectpicker']) }}
        id="subcategoryDropdown" data-live-search="true" title="Category">
    @foreach($categories as $category)
        <optgroup label="{{ $category->name }}">
            @foreach($category->subcategories as $subcategory)
                <option value="{{ $subcategory->slug }}" {{ ($selectedSubcategory == $subcategory->slug) ? 'selected' : ''}}
                data-category="{{ $category->slug }}">{{ $subcategory->name }}</option>
            @endforeach
    @endforeach
</select>
