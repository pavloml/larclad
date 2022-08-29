<select class="form-control selectpicker" name="city_id"
        data-live-search="true" title="City" required>
    @foreach($cities as $city)
        @if($city_id != 0 && is_null(old('city_id')))
            <option value="{{ $city->id }}" {{ ($city_id == $city->id) ? 'selected' : ''}}>{{ $city->name }}</option>
        @else
            <option value="{{ $city->id }}" {{ (old('city_id') == $city->id) ? 'selected' : ''}}>{{ $city->name }}</option>
        @endif
    @endforeach
</select>
