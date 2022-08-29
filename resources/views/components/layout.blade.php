@props(['title' => 'Classified Ads',
'ogMeta' => ['title' => '', 'description' => '', 'type' => '', 'image' => '', 'url' => '']])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ ucfirst($title) }}</title>
    @if($ogMeta['title'] !== '')
        <x-og-meta :metadata="$ogMeta"/>
    @endif
    <meta name="description" content="{{ $ogMeta['description'] !== '' ? $ogMeta['description'] : 'Classified ads website'}}">
    <link rel="canonical" href="{{ $ogMeta['url'] !== '' ? $ogMeta['url'] : url()->current() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Bootstrap & bootstrap plugins css -->
    <link rel="stylesheet" href="{{ mix('/css/bootstrap.css') }}">
    <!-- App css -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <!-- Fonts -->
    <script src="{{ mix('/js/fonts.js') }}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>
<div class="container">
    <header>
        <nav class="navbar navbar-expand-md navbar-light">
            <a class="navbar-brand" href="/">Classified Ads</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNavBar" aria-controls="headerNavBar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="headerNavBar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{ @route('post.create') }}" class="btn btn-primary">Post free ad</a>
                        </li>
                    @auth
                            @can('admin')
                                <li class="nav-item">
                                    <a href="{{ @route('admin')  }}"
                                       class="text-primary nav-link"><i class="fas fa-tools text-primary"></i>  Admin panel <span class="badge text-white bg-primary unreviewed-complains-badge"></span></a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a href="{{ @route('profile') }}"
                                   class="text-info nav-link"><i class="fas fa-user text-info"></i> Your profile <span class="badge text-white bg-info unread-messages-badge"></span></a>
                            </li>
                                <li class="nav-item">
                                    <form action="/logout" method="post" id="logout-form">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-danger nav-link btn btn-link"><i class="fas fa-sign-out-alt text-danger"></i> Log out</button>
                                    </form>
                                </li>
                    @else
                            <li class="nav-item">
                                 <a href="{{ @route('login') }}" class="text-info nav-link"><i class="fas fa-sign-in-alt text-info"></i> Log in</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ @route('register')  }}" class="text-success nav-link"><i class="fas fa-user-plus text-success"></i> Register</a>
                            </li>
                    @endauth
                    </ul>
            </div>
        </nav>
    </header>
    <noscript>
        <div class="alert alert-danger text-center" role="alert">
            This website requires JavaScript
        </div>
    </noscript>
    {{ $slot }}
    <div class="row">
        <div class="col-12">
            <hr>
        </div>
    </div>
    <footer class="row justify-content-around">
        <div class="col-12 col-md-6 text-center">
            <ul class="footer-list">
                <li><a href="{{ @route('static.about') }}">About</a></li>
                <li><a href="{{ @route('static.help') }}">Help</a></li>
{{--                <li><a href="{{ @route('static.safety') }}">Safety</a></li>--}}
                <li><a href="{{ @route('static.privacy') }}">Privacy</a></li>
                <li><a href="{{ @route('static.faq') }}">FAQ</a></li>
                <li><a href="{{ @route('static.contact') }}">Contact</a></li>
            </ul>
        </div>
        <div class="col-12 col-md-3 text-center">
            &copy; {{ @config('app.name') }} 2016-{{ @today()->year }}
        </div>
    </footer>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
@auth
    <script>
        axios.defaults.headers.common['Authorization'] = 'Bearer {{ session('authToken') }}';

        const updateUnreadMessagesCount = (badges) => {
            axios.get('/api/count_unread_messages')
                .then(function (response) {
                    helpers.updateBadges(badges, response.data.count);
                })
                .catch(function (error) {
                    console.log(error);
                })
        }

        const unreadMessagesBadges = document.querySelectorAll('.unread-messages-badge');
        if (unreadMessagesBadges.length !== 0) {
            updateUnreadMessagesCount(unreadMessagesBadges);
            window.setInterval(() => { updateUnreadMessagesCount(unreadMessagesBadges) }, 60000);
        }
    </script>
    @can('admin')
        <script src="{{ mix('/js/admin.js') }}"></script>
    @endcan
@endauth
<script>
    const searchForm = document.getElementById('searchForm')
    if (searchForm) {
        searchForm.addEventListener('change', function (){
            formHelpers.searchFormHelper(searchForm);
        });
    }
</script>
@stack('scripts')
</body>
</html>
