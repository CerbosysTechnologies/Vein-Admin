<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"
        integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Other CSS links here -->
    <style>
        /* Additional custom styles can be added here */
        .login_page .w-full{
           
            box-shadow: none!important;
        }
        #log_in{
            background-color:#0089B3!important;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: "#da373d",
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
                        secondary: "#ebeaf2",
                        light_gray: '#f0f0f1',
                        gray_light: '#d3d3d3',
                    },
                },
            },
        };
    </script>
</head>

<body>
    <div class="login_page">
        <span class="text-left ">
            <img src="{{ asset('images/logo_new.jpg') }}" class="w-20 sm:w-36 mt-4" alt="Logo">
        </span>
        <x-guest-layout>
            <x-auth-card>
                    

                <!-- Admin Login Title -->
                <p class="text-primary text-lg font-medium text-center m-0"><u>Hello Admin!</u></p>
                <h1 class="text-primary m-0 text-3xl font-bold text-center mb-6">Welcome Back</h1>

                <!-- Login Form -->
                <div class="bg-secondary h-96 flex flex-row items-center shadow-md rounded-md p-10">
                    <div class="sm:w-80">
                        <div class="d-flex justify-center items-center text-primary m-0 text-3xl font-bold text-center">
                            Log In
                        </div>
                        <div>
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('admin.adminlogin') }}">
                                @csrf
                                
                                <div class="form-gruop mt-10">
                                    <label class="mb-4 font-medium pl-2">Username</label><br>
                                    <input id="name" type="text" required class="bg-light_gray focus:outline-none h-8 w-full border-[1px] rounded-[0.2rem] border-gray_light p-4" name="name" :value="old('name')"  autofocus placeholder="Enter your Username">
                                </div>
                                <div class="form-gruop mt-5">
                                    <label class="mb-4 font-medium pl-2">Password</label><br>
                                    <input id="password" type="password" required placeholder="Enter Your Password" class="bg-light_gray focus:outline-none h-8 w-full border-[1px] rounded-[0.2rem] border-gray_light p-4" name="password"  autocomplete="current-password">
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                   
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('admin.password.request') }}">
                                            Forgot your password?
                                        </a>
                                </div>
                                <button type="submit" class="bg-primary text-white w-full rounded-[0.2rem] mt-8 p-1" id="log_in">
                                    Log In
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </x-auth-card>
        </x-guest-layout>
    </div>

</body>

</html>
