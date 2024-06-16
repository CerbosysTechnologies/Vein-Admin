@extends('admin.layouts.app')

@section('content')
    <div class="main md:mt-0 mt-6">
        <div class="relative overflow-hidden md:text-md text-lg">
            <div class="bg-white p-4 mt-2">
                <div class="flex justify-between items-center pr-2">
                    <div>
                        <h1 class="font-medium text-xl m-0">Package</h1>
                    </div>
                    <div>
                        <a href="{{ route('admin.package.create') }}">
                            <button class="bg-primary text-white rounded-md  py-2 px-3 text-sm">+ New Package</button>
                        </a>
                    </div>
                </div>
                <div class="shadow-lg p-2 mt-2">
                    <div class="flex justify-between  items-center icon-bar">
                        <div class="">
                            <input type="search" placeholder="Search"
                                class="w-24 sm:w-auto  focus:ring-0 focus:outline-none rounded h-8 text-xs">
                            <button
                                class="bg-primary text-white rounded-r-md  py-[5.8px] px-3 text-sm relative top-[1px] left-[-12px]">Search</button>
                        </div>
                    </div>
                    <div class="mt-4 shadow-md rounded-md overflow-auto">
                        <table class="w-full rounded-md">
                            <thead class="bg-light_blue rounded-md">
                                <tr class="p-2 rounded-md font-semibold text-[0.9rem] whitespace-nowrap">
                                    <th class="px-4 font-semibold p-1 rounded-tl-xl">S. No.</th>
                                    <th class="px-4 font-semibold">Name</th>
                                    <th class="px-4 font-semibold">Image</th>
                                    <th class="px-4 font-semibold">Description</th>
                                    <th class="px-4 font-semibold">Total Test Included</th>
                                    <th class="px-4 font-semibold rounded-tr-md">Price</th>
                                    <th class="px-4 font-semibold p-2.5">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($packages->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <h3>No Package Available</h3>
                                        </td>
                                    </tr>
                                @else
                                    <?php $i = 1; ?>
                                    @foreach ($packages as $package)
                                        <tr class="text-center text-[0.8rem]">
                                            <td class="p-4">{{ $i }}</td>
                                            
                                            <td>{{ $package->package_name }}</td>
                                            <td>
                                                @if ($package->image)
                                                    <img src="{{ asset('package_images/' . $package->image) }}"
                                                        alt="" class="w-8 m-auto">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ $package->description }}</td>
                                            <td>{{ $package->total_test_included }}</td>
                                            <td>{{ $package->price }}</td>
                                            <td>
                                                <div class="flex gap-2 justify-center">
                                                    <a
                                                        href="{{ route('admin.package.edit', ['package' => $package->id]) }}">
                                                        <i
                                                            class="fa-solid fa-pen-to-square text-primary border border-primary text-sm p-0.2 px-1 rounded-[0.2rem]"></i>
                                                    </a>
                                                    <a>
                                                        <i onclick="deleteOpen({{ $package->id }},'package')" class="fa-solid fa-trash-can text-red text-sm p-0.2 px-1 rounded-[0.2rem] border border-red"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $packages->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div id="successMessage" class="max-w-xs z-50 absolute top-[20px] right-[28px] bg-[#bdfcf3] border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 transition duration-75" role="alert">
      <div class="flex p-4">
        <div class="flex-shrink-0">
          <svg class="flex-shrink-0 size-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
          </svg>
        </div>
        <div class="ms-3">
          <p id="successMessageText" class="text-sm text-gray-700 dark:text-gray-400">
            {{ session('success') }}
          </p>
        </div>
      </div>
    </div>
    <script>
      // Fade out the success message after 3 seconds
      setTimeout(function(){
        $('#successMessage').fadeOut('slow');
      }, 3000);
    </script>
  @endif


    <!------------------------- Delete POPUP HTRML -------------------------->
    <div id="delete-popup-package"
        class="overflow-y-auto fixed top-0 hidden w-full z-50 flex justify-center items-center margin-auto h-full bg-black bg-opacity-60 pt-20 ">
        <!-- backdrop filter -->
        <div class="overflow-y-auto bg-white shadow-2xl opacity-100 rounded-2xl mx-8 sm:w-3/6 my-auto mt-20">
            <div class="flex justify-between items-center bg-light_gray  rounded-t-lg py-2.5">
                <h2 class="text-black font-semibold px-7 tracking-normal"> Confirm Delete </h2>
                <i class="fa-regular fa-circle-xmark text-2xl px-2 pt-2" onclick="Delete_Close('package')"></i>
            </div>
            <!-- <h2 id="popTitle">PopUp</h2> -->
            <div class="flex items-center flex-col gap-5 p-5">
                <h2 class="text-black font-medium px-7 tracking-normal"> Are you sure Record? </h2>
                <h2 class="text-black font-medium px-7 tracking-normal"> You will not be able to revert this Record. </h2>
                <!-- <hr> Line -->
                <div class="bg-grey h-px"></div>
                <!-- Close Button -->
                <div class="font-bold flex justify-center flex-wrap gap-3">
                    <div class="font-bold flex justify-center flex-wrap gap-3">
                        <button class="bg-red text-white px-7 py-2 rounded text-sm font-light" onclick="Delete_Close('package')"> No
                        </button>
                        @if($packages->isEmpty())
                            <p>No packages found.</p>
                        @else
                            <button class="bg-green text-white px-7 py-2 rounded text-sm font-light delete-button" data-item-id="{{ $package->id }}" data-item-type="package">Delete Package</button>


                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!------------------------- Delete POPUP HTML -------------------------->


@endsection
