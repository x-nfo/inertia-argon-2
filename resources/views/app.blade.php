<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Favicon --}}
        <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="{{ asset('../assets/img/apple-icon.png') }}"
        />
        <link rel="icon" type="image/png" href="{{ asset('../assets/img/favicon.png') }}" />

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

         <!--     Fonts and icons     -->
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
            rel="stylesheet"
        />
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Nucleo Icons -->
        <link href="{{ asset('../assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('../assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- Main Styling -->

        <!-- Popper -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <link
            href="{{ asset('../assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}"
            rel="stylesheet"
        />

        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>

    <body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">

        @inertia
    </body>
    <!-- plugin for scrollbar  -->
    <script src="{{ asset('../assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <!-- main script file  -->
    <script
        src="{{ asset('../assets/js/argon-dashboard-tailwind.js?v=1.0.1') }}"
        async
    ></script>
</html>