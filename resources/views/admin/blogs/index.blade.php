@extends('admin.layouts.app')
@section('content')
    <div class="main md:mt-0 mt-6">
        <div class="relative overflow-hidden md:text-md text-lg">
            <div class="bg-white p-4 mt-2">
                <div class="flex justify-between items-center pr-2">
                    <div>
                        <h1 class="font-medium text-xl m-0">All Blog</h1>
                    </div>
                    <div>
                        <a href="./add-laboratory.html">
                            <a href="{{ route('admin.blog.create') }}">
                                <button class="bg-primary text-white rounded-md  py-2 px-3 text-sm">+ Add Blog</button>
                            </a>
                    </div>
                </div>
                <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 shadow-md mt-4 mb-4 p-2 gap-5">

                    @foreach ($blogs as $blog)
                        <div
                            class="mb-2 sm:mb-0 max-w-sm p-6 bg-white border-2 border-t-primary rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <h5 class="mb-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $blog->title }}</h5>
                            </a>
                            <div class="description-container">
                                <p class="mb-3 font-normal text-sm text-gray-500 dark:text-gray-400">
                                    @if (strlen($blog->description) > 50)
                                        <span id="dots{{ $blog->id }}">...</span>
                                        <span id="more{{ $blog->id }}" style="display:none;">
                                            {!! nl2br(html_entity_decode(substr($blog->description, 50))) !!}
                                        </span>
                                        <button onclick="toggleDescription({{ $blog->id }})"
                                            id="readMoreBtn{{ $blog->id }}" class="text-primary">Read more</button>
                                    @endif
                                </p>
                            </div>

                            <div class="flex gap-2 justify-center">
                                <button class="bg-primary px-4 py-1 text-sm rounded-[0.2rem] text-white"
                                    onclick="window.location='{{ route('admin.blog.show', $blog->id) }}'">View</button>
                                <a href="{{ route('admin.blog.edit', $blog->id) }}">
                                    <i
                                        class="fa-solid fa-pen-to-square text-primary border border-primary text-sm p-0.2 px-1 rounded-[0.2rem]"></i>
                                </a>
                                <a>
                                    <i onclick="deleteOpen({{ $blog->id }},'blog')"
                                        class="fa-solid fa-trash-can text-red text-sm p-0.2 px-1 rounded-[0.2rem] border border-red"></i>
                                </a>
                            </div>
                            {{-- @if ($blog->featured_image)
                  <img src="{{ asset('images/' . $blog->featured_image) }}" alt="Featured Image" class="mt-2" style="max-width: 100%;">
              @else
                  <h2>No Images</h2>
              @endif --}}
                        </div>
                    @endforeach





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
    <div id="delete-popup-blog"
        class="overflow-y-auto fixed top-0 hidden w-full z-50 flex justify-center items-center margin-auto h-full bg-black bg-opacity-60 pt-20 delete-popup">
        <!-- backdrop filter -->
        <div class="overflow-y-auto bg-white shadow-2xl opacity-100 rounded-2xl mx-8 sm:w-3/6 my-auto mt-20">
            <div class="flex justify-between items-center bg-light_gray  rounded-t-lg py-2.5">
                <h2 class="text-black font-semibold px-7 tracking-normal"> Confirm Delete </h2>
                <i class="fa-regular fa-circle-xmark text-2xl px-2 pt-2" onclick="Delete_Close('blog')"></i>
            </div>
            <!-- <h2 id="popTitle">PopUp</h2> -->
            <div class="flex items-center flex-col gap-5 p-5">
                <h2 class="text-black font-medium px-7 tracking-normal"> Are you sure you want to delete? </h2>
                <h2 class="text-black font-medium px-7 tracking-normal"> You will not be able to revert this Record </h2>
                <!-- <hr> Line -->
                <div class="bg-grey h-px"></div>
                <!-- Close Button -->
                <div class="font-bold flex justify-center flex-wrap gap-3">
                    <div class="font-bold flex justify-center flex-wrap gap-3">
                        <button class="bg-red text-white px-7 py-2 rounded text-sm font-light"
                            onclick="Delete_Close('blog')"> No </button>
                        @if ($blogs->isEmpty())
                            <p>No blogs found.</p>
                        @else
                            <button class="bg-green text-white px-7 py-2 rounded text-sm font-light delete-button"
                                data-item-id="{{ $blog->id }}" data-item-type="blog">Delete blog</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!------------------------- Delete POPUP HTML -------------------------->
@endsection
