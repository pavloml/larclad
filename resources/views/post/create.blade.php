<x-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card border-0">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0" >Create a new ad</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="createPostForm" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="title" class="control-label font-weight-bold">Title: <sup
                                    class="text-danger">*</sup></label>
                                <input type="text" name="title" id="title" class="form-control" maxlength="70"
                                       value="{{ old('title') }}">
                                @error('title')
                                <x-form-error-message :message="$message"/>
                                @enderror

                        </div>
                        <div class="form-group">
                            <label for="city_id" class="control-label font-weight-bold">City: <sup
                                    class="text-danger">*</sup></label>
                                <x-form-cities-dropdown/>
                                @error('city_id')
                                <x-form-error-message :message="$message"/>
                                @enderror

                        </div>
                        <div class="form-group">
                            <label for="subcategory_id" class="control-label font-weight-bold">Category: <sup
                                    class="text-danger">*</sup></label>
                                <x-form-categories-dropdown/>
                                @error('subcategory_id')
                                <x-form-error-message :message="$message"/>
                                @enderror
                        </div>
                        <div class="form-group" id="priceField">
                            <label for="price" class="control-label font-weight-bold">Price: </label>
                                <input type="number" min="0" max="100000000" class="form-control" step="0.01"
                                       name="price" id="price"
                                       value="{{ old('price') }}">
                                @error('price')
                                <x-form-error-message :message="$message"/>
                                @enderror

                        </div>
                        <div class="form-group">
                            <label for="editor" class="control-label font-weight-bold">Description: <sup class="text-danger">*</sup></label>
                    <textarea class="form-control" name="description" id="editor" minlength="10" required maxlength="10000" id="editor">
                        {!! old('description') !!}
                    </textarea>
                                @error('description')
                                <x-form-error-message :message="$message"/>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="control-label font-weight-bold">Image: </label>
                                <input type="file" title="Add images" id="fileUpload" name="image"
                                       class="form-control btn btn-default btn-info">
                                @error('image')
                                <x-form-error-message :message="$message"/>
                                @enderror
                        </div>
                        <hr>
                        @csrf
                        <div class="form-group">
                                <p>Fields marked with <sup class="text-danger">*</sup> are necessary</p>
                                <button type="submit" class="form-control col-12 col-md-6 btn btn-default btn-success">Create ad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ @mix('/js/editor.js') }}"></script>
        <script>
            loadPostImageInput('fileUpload');
            createPostEditor(document.querySelector('#editor'));
            const categoryField = document.querySelector("#subcategory");
            formHelpers.checkIfPriceFieldAvailable(categoryField);

            categoryField.addEventListener('change', function() {
                formHelpers.checkIfPriceFieldAvailable(categoryField);
            });

        </script>
    @endpush
</x-layout>
