@extends('admin.layouts.app')
@section('content')

    <div class="main md:mt-0 mt-6">
      <div class="relative overflow-hidden md:text-md text-lg">
        <div class="bg-white p-4">
          <div class="profile_page w-full sm:w-3/4 m-auto">
            <div class="bg-[#fafafa] overflow-hidden shadow rounded-lg border mt-10 border-4 border-t-primary">
              <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-primary"> My Profile </h3>
              </div>
              
              <form method="POST" action="{{ route('admin.myprofile.update', ['myprofile' => $adminData->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                  <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <div class="block sm:flex">
                      <div class="w-full sm:w-2/5 p-4 profile_img text-center">
                       <!-- Image preview area -->
                        <div class="mt-2">
                            <div class="max-w-[15rem] max-h-[11rem] p-2 border border-dashed border-black rounded-md @if($errors->has('image')) border-red-500 @endif">
                                <div class="">
                                    <!-- Image preview -->
                                    <img id="preview-image" class="max-w-[16rem] p-2 max-h-[10rem] m-auto" src="{{ $adminData->image ? asset($adminData->image) : asset('images/user.png') }}" alt="">

                                </div>
                                <div id="image-name" class="text-sm text-center mt-1 font-bold text-gray-700"></div>
                                
                                <!-- Hidden file input -->
                                <input type="file" name="image" id="file" style="display: none;" onchange="previewImage(event, 'preview-image')">
                                <!-- Button to trigger file input -->
                                <button type="button" onclick="document.getElementById('file').click()" class="mt-2 bg-primary hover:bg-blue-700 text-white font-medium py-2 px-4 rounded text-sm">
                                    Upload Image
                                </button>
                                @error('image')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                  </div>
                    <div class="w-full sm:w-3/5">
                      <dl class="">
                        <div class="py-3 sm:py-3 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                          <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:border-none" placeholder="Enter Name"  value="{{ Auth::guard('admin')->user()->name }}" />
                            @error('name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:border-none" placeholder="Enter Email"  value="{{ Auth::guard('admin')->user()->email }}" />
                            @error('email')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="py-3 sm:py-3 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                          <div class="mb-5">
                            <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact</label>
                            <input type="number" id="contact" name="contact" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 focus:border-none" placeholder="Enter Contact"  value="{{ Auth::guard('admin')->user()->contact }}" />
                            @error('contact')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </dl>
                      <div class="flex justify-end mr-4 mt-2">
                        <button type="button" class="text-white bg-red hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2" onclick="window.location.href='{{ route('admin.dashboard') }}'">Cancel</button>
                        <button type="submit" class="py-1 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-primary rounded-lg border border-primary hover:bg-transparent hover:text-black">Update Profile</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
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
@endsection