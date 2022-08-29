<x-admin.layout :title="$title" back-button-available="true">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-2">
        <x-session-alerts />
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-4 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-header">
                        <div class="h4">Edit a category</div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.categories.update', ['id' => $category->id]) }}">
                            <div class="alert alert-info">
                                The slug will be updated automatically
                            </div>
                            <div class="form-group">
                                <label for="name">Category name</label>
                                <input type="text" name="name" id="name" class="form-control" min="2" max="50"
                                       placeholder="Name of the category" value="{{ old('name') ?: $category->name }}" required>
                                @error('name')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="priceFieldAvailable">Make the price field available for this category?</label>
                                <div class="form-control">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" {{ $category->price_field_available ? 'checked' : '' }}
                                        type="radio" name="price-field-available" id="priceFieldYes" value="1">
                                        <label class="form-check-label" for="priceFieldYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" {{ $category->price_field_available ? '' : 'checked' }}
                                        type="radio" name="price-field-available" id="priceFieldNo" value="0">
                                        <label class="form-check-label" for="priceFieldNo">No</label>
                                    </div>
                                </div>
                                @error('price-field-available')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success">
                                    Update category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>

