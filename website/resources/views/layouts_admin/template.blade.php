<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? config('app.name', 'JTIntern') }}</title>

        {{-- Google Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

        {{-- Bootstrap 5 CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous">

        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

        {{-- DataTables CSS --}}
        <link href="https://cdn.datatables.net/v/dt/dt-2.3.8/datatables.min.css"
            rel="stylesheet"
            integrity="sha384-1BvCnyKidMPIGQGjvMn+w+90hHBhYJtF+R7os4NX2Abe7tSxWQadHRTSH5qb559A"
            crossorigin="anonymous">

        {{-- SweetAlert2 CSS --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        
        {{-- Custom CSS --}}
        <link rel="stylesheet" href="{{ asset('css/layout_admin.css') }}">
        @stack('css')
    </head>
    <body>
        {{-- Header --}}
        @include('layouts_admin.header')

        {{-- Sidebar --}}
        @include('layouts_admin.sidebar')
        
        {{-- Main Content --}}
        <main class="p-3">
            {{-- Breadcrumb --}}
            @include('layouts_admin.breadcrumb')

            {{-- Page Content --}}
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('layouts_admin.footer')

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        {{-- =============================================
        JavaScript
        ============================================= --}}

        {{-- jQuery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
                crossorigin="anonymous"></script>

        {{-- Bootstrap 5 JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
                crossorigin="anonymous"></script>

        {{-- DataTables JS --}}
        <script src="https://cdn.datatables.net/v/dt/dt-2.3.8/datatables.min.js"
                integrity="sha384-kjkli48Tmhwhaghq0IIRm8gFmMdnihfu1ywAOyyGWYMsoZZi/6AX2fWzpsqahoFw"
                crossorigin="anonymous"></script>

        {{-- SweetAlert2 --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- csrf token --}}
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        {{-- Custom Javascript --}}
        <script src="{{ asset('js/sidebar.js') }}"></script>
        @stack('js')
    </body>
</html>
