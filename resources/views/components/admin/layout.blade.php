@props(['title' => config('app.name') . ' Admin', 'backButtonAvailable' => false])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <title>{{ ucfirst($title) }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Bootstrap & bootstrap plugins css -->
    <link rel="stylesheet" href="{{ mix('/css/bootstrap.css') }}">
    <!-- App css -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/admin.css') }}">
    <!-- Fonts -->
    <script src="{{ mix('/js/fonts.js') }}"></script>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>
<nav class="navbar navbar-dark navbar-expand sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('admin') }}">{{ config('app.name') . ' Admin' }}</a>
    <ul class="navbar-nav nav">
        @if($backButtonAvailable)
            <li class="nav-item">
                <a class="nav-link" href="{{ url()->previous() }}">
                    <i class="fas fa-arrow-left"></i>
                    Go Back
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-door-open"></i>
                Exit admin panel
            </a>
        </li>
    </ul>
    <form action="/logout" class="form-inline ml-auto" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-danger nav-link btn btn-link"><i class="fas fa-sign-out-alt text-danger"></i> Log out</button>
    </form>
</nav>
<x-admin.side-menu />
{{ $slot }}
<script src="{{ mix('/js/app.js') }}"></script>
<script>
    axios.defaults.headers.common['Authorization'] = 'Bearer {{ session('authToken') }}';
</script>
<script src="{{ mix('/js/admin.js') }}"></script>
@stack('scripts')

</body>
</html>
