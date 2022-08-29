<x-admin.layout :title="$title" back-button-available="true">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 pl-2">
        <x-session-alerts />
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-4 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-header">
                        <div class="h4">Edit a subcategory</div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.subcategories.update', ['id' => $subcategory->id]) }}">
                            <div class="form-group">
                                <label for="categoryName">Parent category name</label>
                                <input type="text" class="form-control" id="categoryName" readonly value="{{ $subcategory->category->name }}">
                            </div>
                            <div class="alert alert-info">
                                The slug will be updated automatically
                            </div>
                            <div class="form-group">
                                <label for="name">Subcategory name</label>
                                <input type="text" name="name" id="name" class="form-control" min="2" max="50"
                                       placeholder="Name of the subcategory" value="{{ old('name') ?: $subcategory->name }}" required>
                                @error('name')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success">
                                    Update subcategory
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-admin.layout>

