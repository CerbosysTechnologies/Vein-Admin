<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vein Healthcare</title>
    <meta name="author" content="name" />
    <meta name="description" content="description here" />
    <meta name="keywords" content="keywords,here" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.svg') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <!-- CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: "#DA373D",
                        blue: "#00BAF2",
                        darkblue: "#073B74",
                        grey: "#858C8E",
                        lightw: "#D9D9D9",
                        white: "#fff",
                        green: "#3BB77E",
                        yellow: "#FFE144",
                        primary: "#0089B3",
                        textcol: "#253D4E",
                        darkblak: "#3C3C3C",
                        lightgreen: "#BCEFD8",
                        secondary: "#EBEAF2",
                        light_gray: '#F0F0F1',
                        gray_light: '#D3D3D3',
                        light_blue: '#0089b330',
                        red: "#DA0000",

                    },
                },
            },
        };
    </script>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #F9F9F9;
            min-width: 100%;
            border: 1px solid #ddd;
            padding: 5px;
            z-index: 1;
        }

        .dropdown-content label {
            display: block;
            margin-bottom: 3px;
        }

        /* CSS for image preview container */
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
        }

        /* CSS for individual preview images */
        .image-preview-container img {
            height: 100px;
            /* Adjust as needed */
            width: auto;
            margin-right: 10px;
            /* Adjust spacing between images */
            margin-bottom: 10px;
            /* Adjust spacing between rows */
        }
    </style>
</head>

<body class="font-sans antialiased">
    @include('admin.partials.navbar')
    <main>
        <div class="main-container">
            <div class="navcontainer">
                @include('admin.partials.sidebar')
            </div>
            @yield('content')
        </div>
    </main>

    <!-- Include scripts -->
    @include('admin.partials.scripts')
</body>

</html>
