@props(['selectedCity' => 'all'])
<select {{  $attributes->merge(['class' => 'form-control selectpicker']) }}
        data-live-search="true" title="City" id="cityDropdown">
    @foreach($cities as $city)
        <option value="{{ $city->slug }}" {{ ($selectedCity == $city->slug) ? 'selected' : ''}}>{{ $city->name }}</option>
    @endforeach
</select>
