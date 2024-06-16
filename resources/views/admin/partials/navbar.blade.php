<header class="flex w-full  h-auto p-1 bg-white">
    <div class="logosec ml-2  my-2">
        <img src="{{ asset('images/logo_new.jpg') }}" alt="adminlogo" class="w-[6rem] sm:w-[12rem]" />
        <div class="">
            <i class="icn menuicn fa-solid font-bold text-lg fa-bars text-[#0163d2] inline openbtn bg-[#EFEFEF] p-2.5 rounded-full w-9 h-9 text-primary"></i>
        </div>
    </div>
    <div class="flex  max-w-lg justify-center  text-white px-2">
        <div class=" flex justify-center items-center">
            <div class="search-menu relative p-4 w-auto hidden md:block">
                <input type="text" placeholder="Search" id="searchInput" class="mat-input search bg-[#EFEFEF] border-none rounded-tl-lg rounded-bl-lg h-8 pr-20 py-4 text-black"> <!-- Add text-black class -->
                <span class="icon-div absolute right-[0rem] flex top-[15px] justify-center items-center p-2 border border-l-[1px] border-white bg-[#EFEFEF] rounded-tr-lg rounded-br-lg" id="searchIcon">
                    <i class="fa fa-search text-grey" aria-hidden="true"></i>
                </span>
            </div>

            <!-- Suggestions dropdown -->
            <div id="suggestionsDropdown" class="hidden absolute bg-white shadow-md z-10 text-black"> <!-- Add text-black class -->
                <!-- Suggestions will be dynamically added here -->
            </div>

            <span class="flex"></span>
        </div>
    </div>
    <div class="flex  pt-2 content-center justify-between md:w-1/4 md:justify-end">
        {{-- <h4>{{ Auth::guard('admin')->name }}</h4> --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
        <div class="user_dropdown">
            <img onclick="myUser()" class="dropbtn h-auto w-10 sm:h-10" src="{{ asset('images/user.png') }}" alt="">
            <div id="myDropdown" class="dropdown-content">
                <a href="" class="border border-b-[#01b59c]">My Profile</a>
                <a href="./forgot-password.html" class="border border-b-[#01b59c]">Forgot Password</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</header>
