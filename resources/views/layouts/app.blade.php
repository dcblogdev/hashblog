<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - {{ config('app.name') }}</title>
  <link rel="canonical" href='{{ url()->current() }}'>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @yield('meta')
</head>
<body class="bg-gray-900 text-white">

<nav class="bg-indigo-800 shadow py-2 mb-10">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
        <div class="flex-shrink py-2">
            <div class="flex px-2 lg:px-0">

                <a href='{{ url('/') }}'>
                    <div class="flex items-center">
                        <div class="block px-1 pt-1 text-sm font-medium leading-5 text-white hover:text-gray-300">
                            <div>{{ config('app.name') }}</div>
                        </div>
                    </div>
                </a>

                <div class="flex flex-grow justify-between">

                    <div class="lg:ml-6 lg:flex">

                        <a href="/" class="ml-8 inline-flex items-center px-1 pt-1 text-sm text-white hover:text-gray-300">Blog</a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</nav>

    <div class="container px-8 mx-auto">
      @yield('content')
    </div>

</body>
</html>