<select class="form-control selectpicker" name="subcategory_id" id="subcategory"
        data-live-search="true" title="Category" required>
    @foreach($categories as $category)
        <optgroup label="{{ $category->name }}">
        @foreach($category->subcategories as $subcategory)

            @if($subcat_id != 0 && is_null(old('subcategory_id')))
                    <option data-price-available='{{ $category->price_field_available  ? 'true' : 'false'  }}'
                            value="{{ $subcategory->id }}" {{ ($subcat_id == $subcategory->id) ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                @else
                    <option data-price-available='{{ $category->price_field_available  ? 'true' : 'false'  }}'
                            value="{{ $subcategory->id }}" {{ (old('subcategory_id') == $subcategory->id) ? 'selected' : ''}}>{{ $subcategory->name }}</option>

            @endif
        @endforeach
    @endforeach
</select>
