<x-admin.layout :title="$title" back-button-available="true">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-2">
        <x-session-alerts />
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-4 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-header">
                        <div class="h4">Add a subcategory</div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.subcategories.store', ['category_id' => $category->id]) }}">
                            <div class="form-group">
                                <label for="categoryName">Parent category name</label>
                                <input type="text" class="form-control" id="categoryName" readonly value="{{ $category->name }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Subcategory name</label>
                                <input type="text" name="name" id="name" class="form-control" min="2" max="50"
                                       placeholder="Name of the subcategory" value="{{ old('name') }}" required>
                                @error('name')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success">
                                    Add subcategory
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>
