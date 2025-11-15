<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap 5 CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom styles -->
    <link href="{{ asset('public/assets/css/styles.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">
@include('admin.layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
      @include('admin.layouts.sidebar')

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            @yield('content')
        </main>
    </div>
</div>


<footer class="text-center py-3">
    <small>&copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<!-- Bootstrap 5 JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" ></script>

@stack('scripts')
<!-- Update Slug scripts -->
                    <script>
                        function updateSlug() {
                            const titleElement = document.getElementById('title');
                            const slugElement = document.getElementById('slug');
                            const title = titleElement.value;
                            const slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            slugElement.value = slug;
                        }
                    </script>

<!-- Custom scripts for ajax alert-->
                   

</body>
</html>