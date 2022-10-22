<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Books | {{ $title_page }} </title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />

    @include('layouts.theme.styles')

</head>

<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('layouts.theme.header')
    {{-- @include('livewire.navbar') --}}

    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container mt-5" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        @include('layouts.theme.topbar')

        <!--  END TOPBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('content')
            </div>

            <!--BEGIN FOOTER-->
            @include('livewire.layouts.footer')

            <!--END FOOTER-->
        </div>




        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->
    @include('livewire.layouts.scripts')
    @include('livewire.layouts.links')
    @include('layouts.theme.scripts')

</body>

</html>
