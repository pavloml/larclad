<x-layout :title="$title" :og-meta="$post->getOgMeta()">
<x-search-form />
    <x-session-alerts />
    @if(!$post->active)
    <div class="alert alert-warning" role="alert">
        This post is not active
    </div>
    @endif
<div class="row">
    <div class="col-12 breadcrumb-line">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('post.search', ['city' => $post->city->slug, 'category' => 'all'])  }}">All ads in {{ $post->city->name }}
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('post.search', ['city' => $post->city->slug, 'category' => $post->subcategory->category->slug])  }}">
                    {{ $post->subcategory->category->name }}
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('post.search', ['city' => $post->city->slug, 'category' => $post->subcategory->category->slug, 'subcategory' => $post->subcategory->slug])  }}">
                    {{ $post->subcategory->name }}
                </a>
            </li>
            <li class="breadcrumb-item active" >{{ $post->title }}</li>
        </ol>
    </div>
</div>

<main class="row justify-content-center">
    <div class="col-12 col-md-8">
        <h1 class="ad-head-line text-center">{{ $post->title }}</h1>
        @if(!$post->images->isEmpty())
            <div class="image-container d-flex justify-content-center">
            <a href="{{ asset($post->getMainImage()->full_size_path) }}" class="glightbox" data-gallery="post">
                <x-post-image src="{{ asset($post->getMainImage()->full_size_path) }}"/>
            </a>
            </div>
        @endif
        <div class="mt-2 d-flex flex-wrap justify-content-center justify-content-md-around post-time">
            <div class="time-tooltip"
                 data-toggle="tooltip"
                 data-placement="top"
                 title="{{$post->updated_at}}"
                 onclick="helpers.replaceText(this,'Updated: ' + '{{$post->updated_at}}')">
                Updated: <x-time :time="$post->updated_at" diff_for_humans="true" />
            </div>
            <div class="time-tooltip"
                 data-placement="top"
                 title="{{$post->created_at}}"
                 onclick="helpers.replaceText(this, 'Created: ' + '{{$post->created_at}}')">
                Created: <x-time :time="$post->created_at" diff_for_humans="true" />
            </div>
        </div>
        <div class="ad-description mt-2"> {!! $post->description !!} </div>
    </div>
    <aside class="col-12 col-md-4 col-lg-3 post-aside">
        @if($post->subcategory->category->price_field_available)
            <div class="price bg-success">{{ $post->price ? '$ ' . $post->price : 'Free' }}</div>
        @endif
        @auth
            @if($post->user_id !== Auth::id())
                <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#contactAuthor">
                    <i class="fas fa-envelope"></i>
                    Message
                </button>
            @endif
        @else
            <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#unauthenticatedUserModal">
                <i class="fas fa-envelope"></i>
                Message
            </button>
        @endauth
        <button class="btn btn-info btn-lg" id="adPhoneNumber" onclick="getPhoneNumber({{ $post->id }})">
            <i class="fas fa-phone-alt"></i>
            Phone number
        </button>
        <div class="ad-location">
            <span>{{ $post->city->name }}</span>
        </div>
        <div class="user"><i class="fas fa-user"></i> {{ $post->user->name }} <br>
            <small class="text-muted">User since <time>{{ $post->user->created_at->format("F Y") }}</time></small></div>
        <div class="manage-post ml-3">
            <ul class="list-unstyled vertical-menu">
                <li id="favorite-post-section">
                    <a href="javascript:addToFavorites({{ $post->id }})" class="text-dark">
                        <i class="far fa-star text-dark"></i>Favorite
                    </a>
                </li>
                <li>
                    <a href="#" class="text-danger" data-toggle="modal" data-target="#reportModal">
                        <i class="fas fa-exclamation-triangle text-danger"></i>Report abuse
                    </a>
                </li>

            @auth
                    @can('update', $post)
                    <li>
                        <a href="{{ url("/post/edit/$post->id") }}">
                            <i class="fas fa-cog text-primary"></i>Edit this ad
                        </a>
                    </li>
                    @endcan
{{--                    @can('delete', $post)--}}
{{--                            <li>--}}
{{--                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#deletePostModal" data-action-link="{{ url("/post/$post->id") }}">--}}
{{--                                    <i class="fas fa-trash"></i>--}}
{{--                                    Delete--}}
{{--                                </button>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
                @endauth
            </ul>
        </div>
    </aside>
</main>

    <x-modal.contact-author-modal />
    <x-modal.report-abuse-modal />
    <x-modal.alert-modal />
    <x-modal.unauthenticated-modal />

@push('scripts')
        <script src="{{ mix('/js/lightbox.js') }}"></script>
        <script>
            window.addEventListener('load', function () {
                helpers.addDeferredCSS('{{ mix('/css/lightbox.css') }}');

                const lightbox = GLightbox({
                    touchNavigation: true,
                    loop: true,
                    autoplayVideos: true
                });
            });
        </script>
        <script>
            const postId = {{ $post->id }};
            const complainUrl = '{{ route('api.complain.store') }}';

            const reportAbuseForm = document.querySelector('#reportAbuseForm');
            const sendMessageForm = document.querySelector('#sendMessageForm');
            const alertModalMessage = document.querySelector('#alertModalMessage');

            $('#alertModal').on('hidden.bs.modal', function () {
                alertModalMessage.classList.remove('alert-success');
                alertModalMessage.classList.remove('alert-danger');
            })

            if (favoritePosts.checkIfPostInFavorites(postId)) {
                replaceFavoriteButton(postId, 'remove');
            }

            sendMessageForm.onsubmit = (e) => {
                e.preventDefault();
                axios.post(`/api/send_message/${postId}`, {
                    'message': sendMessageForm.message.value
                }).then(function (response) {
                    sendMessageForm.message.value = '';
                    alertModalMessage.classList.add('alert-success');
                    alertModalMessage.textContent = 'Your message has been successfully sent';
                    $('#alertModal').modal('show');
                }).catch(function (error) {
                    console.log(error)
                    alertModalMessage.classList.add('alert-danger');
                    alertModalMessage.textContent = 'We are unable to send your message. Please try again later';
                    $('#alertModal').modal('show');
                }).then(function () {
                    $('#contactAuthor').modal('hide');
                });
            }

            reportAbuseForm.onsubmit = (e) => {
                e.preventDefault();
                axios.post(complainUrl, {
                    'postId': postId,
                    'reason': reportAbuseForm.reason.value
                }).then(function (response) {
                    reportAbuseForm.reason.value = '';
                    alertModalMessage.classList.add('alert-success');
                    alertModalMessage.textContent = 'Your report has been successfully sent';
                    $('#alertModal').modal('show');
                }).catch(function (error) {
                    console.log(error);
                    alertModalMessage.classList.add('alert-danger');
                    alertModalMessage.textContent = 'We are unable to send your report. Please try again later';
                    $('#alertModal').modal('show');
                }).then(function () {
                    $('#reportModal').modal('hide');
                });
            }

            function replaceFavoriteButton(postId, newType) {
                let section = document.querySelector('#favorite-post-section');

                if(section.querySelector('svg') !== null) {
                    section.querySelector('svg').remove()
                }else{
                    section.querySelector('i').remove();
                }

                let icon = document.createElement('i');
                let link = section.querySelector('a');
                if (newType === 'remove') {
                    icon.classList.add('fa', 'fa-star', 'text-warning');
                    link.textContent = 'Remove from favorites'
                    link.href=`javascript:removeFromFavorites(${postId})`;
                }else{
                    icon.classList.add('far', 'fa-star', 'text-dark');
                    link.textContent = 'Favorite'
                    link.href=`javascript:addToFavorites(${postId})`;
                }
                link.prepend(icon);
            }

            function removeFromFavorites(postId) {
                favoritePosts.removePostFromFavorites(postId);
                replaceFavoriteButton(postId, 'add');
            }

            function addToFavorites(postId) {
                favoritePosts.addPostToFavorites(postId);
                replaceFavoriteButton(postId, 'remove');
            }

            function getPhoneNumber(postId) {
                const phoneNumberElement = document.querySelector('#adPhoneNumber');
                axios.get(`/api/phone_number/${postId}`)
                    .then(function (response) {
                        phoneNumberElement.textContent = phoneNumber.formatToLocal(response.data.phone);
                    })
                    .catch(function (error) {
                        console.log(error);
                        alertModalMessage.classList.add('alert-danger');
                        alertModalMessage.textContent = 'We are unable to get the contact phone number. Please try again later';
                        $('#alertModal').modal('show');
                    })
            }

        </script>
    @endpush
</x-layout>
