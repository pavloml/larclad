<select class="form-control selectpicker" name="subcategory_id"
        data-live-search="true" title="Subcategory" required>
        @foreach($category->subcategories as $subcategory)

            @if($subcat_id != 0 && is_null(old('subcategory_id')))
                    <option value="{{ $subcategory->id }}" {{ ($subcat_id == $subcategory->id) ? 'selected' : ''}}>{{ $subcategory->name }}</option>
                @else
                    <option value="{{ $subcategory->id }}" {{ (old('subcategory_id') == $subcategory->id) ? 'selected' : ''}}>{{ $subcategory->name }}</option>

            @endif
        @endforeach
</select>
