<x-layout :title="$title">

<x-profile-header />

<div class="row mb-3">
    <div class="col-12">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a class="{{ request()->is('profile/posts') ? 'active' : '' }} nav-link" href="{{ url('profile/posts') }}">Active</a>
            </li>
            <li class="nav-item">
                <a class="{{ request()->is('profile/posts/inactive') ? 'active' : '' }} nav-link" href="{{ url('profile/posts/inactive') }}">Inactive</a>
            </li>
        </ul>
    </div>
</div>
@if(!$posts->isEmpty())
        <section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
            @foreach($posts as $post)
                <article class="col mb-4 post-in-own-posts">
                    <div class="card border h-100">
                        @if(!$post->images->isEmpty())
                            <x-post-thumbnail src="{{ asset($post->getMainImage()->thumbnail_path) }}" />
                        @else
                            <x-post-thumbnail />
                        @endif
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ url("/post/$post->id/$post->slug") }}">{{ $post->title }}</a></h5>
                            <div class="card-text">
                                @if($post->subcategory->category->price_field_available)
                                    <p class="h4">
                                        <span class="info">{{ $post->price ? '$ ' . $post->price : 'Free' }}</span>
                                    </p>
                                @endif
                                <small class="d-block">{{ $post->subcategory->name }}</small>
                                    <small class="d-block my-1">{{ $post->city->name }}</small>
                                <small>
                                    <x-time :time="$post->updated_at" diff_for_humans="true" />
                                </small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="{{ url("/post/edit/$post->id")  }}" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal" data-action-link="{{ url("/post/$post->id") }}"> <i class="fas fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>
        <div class="row">
            <div class="col-12 text-center">
                {{ $posts->onEachSide(0)->links() }}
            </div>
        </div>
@else
        <div class="row mt-1">
            <div class="col-12 text-center">
                <p class="h4">No ads yet</p>
            </div>
        </div>
    @endif

    <x-modal.delete-post-modal />

    @push('scripts')
        <script>
        $('#deletePostModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            document.querySelector('#deletePostModalForm').setAttribute('action', button.data('action-link'));
        })
        </script>

    @endpush
</x-layout>
