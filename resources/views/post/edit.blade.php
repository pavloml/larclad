<x-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card border-0">
                <div class="card-header bg-transparent">
                    <h3 class="card-title mb-0">Edit the ad</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="editPostForm" enctype="multipart/form-data" method="post"
                          action="{{ route('post.update', ['id' => $post->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="control-label font-weight-bold">Ad status: <sup
                                    class="text-danger">*</sup></label>
                                <div class="custom-control custom-switch mb-3">
                                    <input type="checkbox" name="active"
                                           {{ $post->active ? 'checked' : ''}} class="custom-control-input"
                                           id="activeSwitch">
                                    <label class="custom-control-label" for="activeSwitch">Active</label>
                                </div>
                                @error('active')
                                <x-form-error-message :message="$message"/>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="title" class="control-label font-weight-bold">Title: <sup
                                    class="text-danger">*</sup></label>
                            <div class="">
                                <input type="text" name="title" id="title" class="form-control" maxlength="70"
                                       value="{{ old('title') ?? $post->title }}">
                                @error('title')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="city_id" class="control-label font-weight-bold">City: <sup
                                    class="text-danger">*</sup></label>
                            <div class="">
                                <x-form-cities-dropdown :city="$post->city_id"/>
                                @error('city_id')
                                <x-form-error-message :message="$message"/>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="subcategory_id" class="control-label font-weight-bold">Category: <sup
                                    class="text-danger">*</sup></label>
                            <x-form-categories-dropdown :cat="$post->subcategory_id"/>
                            @error('subcategory_id')
                            <x-form-error-message :message="$message"/>
                            @enderror
                        </div>

                        <div class="form-group" id="priceField">
                            <label for="price" class="control-label font-weight-bold">Price: </label>
                            <input type="number" min="0" max="100000000" class="form-control" step="0.01" name="price"
                                   id="price"
                                   value="{{ old('price') ?? ($post->price != 0 ? $post->price : '')}}">
                            @error('price')
                            <x-form-error-message :message="$message"/>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label font-weight-bold">Description: <sup
                                    class="text-danger">*</sup></label>
                            <textarea class="form-control" name="description"  minlength="10" required maxlength="10000" id="editor">
                        {!! old('description') ?? $post->description !!}
                    </textarea>
                            @error('description')
                            <x-form-error-message :message="$message"/>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="image" class="control-label font-weight-bold">Image: </label>
                            <div id="postImage">
                                @if( !$post->images->isEmpty())
                                    <div id="existingImage">
                                        <x-post-image src="{{ asset($post->getMainImage()->thumbnail_path) }}"/>
                                        <div class="edit-image-buttons mt-2">
                                            <button class="btn btn-primary" id="editImageButton"
                                                    onclick="editPostImage(event)">Replace image
                                            </button>
                                            <button class="btn btn-danger" id="removeImageButton"
                                                    onclick="removePostImage(event)">Remove image
                                            </button>
                                        </div>
                                    </div>

                                @else
                                    <input type="file" title="Add images" id="fileUpload" name="image"
                                           class="form-control btn btn-default btn-info">
                                    @error('image')
                                    <x-form-error-message :message="$message"/>
                                    @enderror
                                @endif
                            </div>


                        </div>
                        <hr>
                        <div class="form-group">
                            <p>Fields marked with <sup class="text-danger">*</sup> are necessary</p>
                            <button type="submit" class="form-control col-12 col-md-6 btn btn-default btn-success">Update</button>
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

            function createModifyImageButtons(node) {
                let editButton = document.createElement('button');
                let removeButton = document.createElement('button');

                editButton.textContent = 'Replace image';
                removeButton.textContent = 'Remove image';

                editButton.classList.add('btn', 'btn-primary');
                removeButton.classList.add('btn', 'btn-danger');

                editButton.id = 'editImageButton';
                removeButton.id = 'removeImageButton';

                editButton.setAttribute('onclick', 'editPostImage(event)');
                removeButton.setAttribute('onclick', 'removePostImage(event)');

                node.append(editButton, '\n', removeButton);
            }


            function editPostImage(event) {
                event.preventDefault();
                document.getElementById('existingImage').remove();
                document.getElementById('postImage').innerHTML = '<input type="file" title="Add images" id="fileUpload" name="image" class="form-control btn btn-default btn-info">';
                loadPostImageInput('fileUpload');

            }

            function doNotRemovePostImage(event) {
                event.preventDefault();
                document.querySelector('#removeImageFlag').remove();
                document.querySelector('#removeImageWarningText').remove();
                document.querySelector('#doNotRemoveImageButton').remove();
                let editButtonsSection = document.querySelector('.edit-image-buttons');
                createModifyImageButtons(editButtonsSection);
            }

            function removePostImage(event) {
                event.preventDefault();
                document.querySelector('#editImageButton').remove();
                document.querySelector('#removeImageButton').remove();
                let warningText = document.createElement('p');
                warningText.classList.add('text-danger');
                warningText.id = 'removeImageWarningText';
                warningText.textContent = 'The image will be removed';
                document.querySelector('#postImage').insertBefore(warningText, document.querySelector('#existingImage'));

                let doNotRemoveButton = document.createElement('button');
                doNotRemoveButton.id = 'doNotRemoveImageButton';
                doNotRemoveButton.textContent = 'Don\'t remove image';
                doNotRemoveButton.classList.add('btn', 'btn-success');
                doNotRemoveButton.setAttribute('onclick', 'doNotRemovePostImage(event)');

                let removeFlag = document.createElement('input');
                removeFlag.setAttribute('type', 'hidden');
                removeFlag.setAttribute('name', 'removeImage');
                removeFlag.setAttribute('value', 'true');
                removeFlag.id = 'removeImageFlag';

                document.querySelector('#editPostForm').append(removeFlag);
                document.querySelector('.edit-image-buttons').appendChild(doNotRemoveButton);

            }

        </script>
    @endpush
</x-layout>
