@extends('admin.layouts.app')

@section('content')
    <div class="main md:mt-0 mt-6">
        <div class="relative overflow-hidden md:text-md text-lg">
            <div class="bg-white p-4 mt-2">
                <div class="flex items-center w-full">
                    <h1 class="font-medium text-xl m-0 text-primary whitespace-nowrap mr-2">Add Package</h1>
                    <div class="flex items-center w-full mt-[2px]">
                        <i class="fa-solid fa-diamond text-primary text-[0.5rem]"></i>
                        <div class="w-full border-t border-primary"></div>
                    </div>
                </div>
                <form action="{{ route('admin.package.update', $packages->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="shadow-md mt-4 p-2 pb-10">
                        <div class="m-5 flex flex-wrap sm:flex-nowrap gap-4">
                            <div class="mt-2 {{ $errors->has('name_en') ? 'border-red-500' : '' }}">
                                <label for="name_en" class="text-sm font-medium">
                                    <span class="text-red">*</span> Name in English</label>
                                <input type="text" name="name_en" id="name_en"
                                    class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('name_en')) border-red-500 @endif"
                                    placeholder="Name in English" value="{{ $translations['en']->package_name }}">
                                @error('name_en')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                                                    
                            <div class="mt-2 {{ $errors->has('name_hi') ? 'border-red-500' : '' }}">
                                <label for="name_hi" class="text-sm font-medium">
                                    <span class="text-red">*</span> Name in Hindi</label>
                                <input type="text" name="name_hi" id="name_hi"
                                    class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('name_hi')) border-red-500 @endif"
                                    placeholder="Name in Hindi" value="{{ $translations['hi']->package_name }}">
                                @error('name_hi')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                                                    
                            <div class="mt-2 {{ $errors->has('name_mr') ? 'border-red-500' : '' }}">
                                <label for="name_mr" class="text-sm font-medium">
                                    <span class="text-red">*</span> Name in Marathi</label>
                                <input type="text" name="name_mr" id="name_mr"
                                    class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('name_mr')) border-red-500 @endif"
                                    placeholder="Name in Marathi" value="{{ $translations['mr']->package_name }}">
                                @error('name_mr')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="mt-2 flex flex-wrap sm:flex-nowrap gap-4">
                            <div class="w-full">
                                <div>
                                    <label for="add_test" class="text-sm font-medium">

                                        <span class="text-red">*</span> Add Tests
                                    </label>
                                    <div class="mt-2">
                                        <div class="dropdown w-full" id="dropdown">
                                            <div onclick="toggleDropdown()"
                                                class="btn btn-secondary flex border border-grey rounded-md p-2 text-sm justify-between items-center w-full">
                                                Select<svg class="svg-icon"
                                                    style="width: 1.666015625em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;"
                                                    viewBox="0 0 1706 1024" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M782.02272703 706.46395178L457.91614086 317.53604822h648.21317271z" />
                                                </svg></div>
                                                <div class="dropdown-content  border border-grey overflow-scroll" id="dropdown-content">
                                                    @foreach ($tests as $test)
                                                        <label>
                                                            <input type="checkbox" value="{{ $test->id }}"
                                                                onchange="updateTotalCount(this)"
                                                                name="selected_tests[]"
                                                                data-price="{{ $test->price }}"
                                                                checked> <!-- Assuming $tests contains only saved tests -->
                                                            {{ $test->test_name }} - {{ $test->price }}
                                                        </label>
                                                    @endforeach
                                                
                                                    @foreach ($alltests as $test)
                                                        @php
                                                            $isChecked = in_array($test->id, $packageTests);
                                                        @endphp
                                                        @unless ($isChecked)
                                                            <label>
                                                                <input type="checkbox" value="{{ $test->id }}"
                                                                    onchange="updateTotalCount(this)"
                                                                    name="selected_tests[]"
                                                                    data-price="{{ $test->price }}">
                                                                {{ $test->test_name }} - {{ $test->price }}
                                                            </label>
                                                        @endunless
                                                    @endforeach
                                                </div>
                                                
                                        </div>
                                    </div>
                                    
                                    @error('selected_tests[]')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-full">
                                <div class="mt-2 {{ $errors->has('total_test_included') ? 'border-red-500' : '' }}">
                                    <label for="total_test_included" class="text-sm font-medium">
                                        <span class="text-red">*</span> Total Test Included </label>
                                    <input type="text" name="total_test_included" value="{{ $packages->total_test_included }}" id="total_test_included"
                                        class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('total_test_included')) border-red-500 @endif "
                                        placeholder="Total Test Included" readonly>
                                </div>
                                @error('total_test_included')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="w-full">
                                <div class="mt-2 {{ $errors->has('price') ? 'border-red-500' : '' }}">
                                    <label for="package_name" class="text-sm font-medium">
                                        <span class="text-red">*</span> Price </label>
                                    <input type="text" name="price" id="price"
                                        class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm " placeholder="Price" readonly
                                        value="{{ $packages->price }}">
                                    @error('price')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 flex flex-wrap sm:flex-nowrap  gap-6">
                            <div class="w-full">
                                <div class="mt-2 {{ $errors->has('description_en') ? 'border-red-500' : '' }}">
                                    <label for="description_en" class="text-sm font-medium">Description in English</label>
                                    <textarea name="description_en" id="description_en" cols="20" rows="2" class="mt-2 w-full p-2 rounded-md focus:ring-0 text-sm resize-none" placeholder="Description in English">{{ $translations['en']->description }}</textarea>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="mt-2 {{ $errors->has('description_hi') ? 'border-red-500' : '' }}">
                                    <label for="description_hi" class="text-sm font-medium">Description in Hindi</label>
                                    <textarea name="description_hi" id="description_hi" cols="20" rows="2" class="mt-2 w-full p-2 rounded-md focus:ring-0 text-sm resize-none " placeholder="Description in Hindi">{{ $translations['hi']->description }}</textarea>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="mt-2 {{ $errors->has('description_mr') ? 'border-red-500' : '' }}">
                                    <label for="description_mr" class="text-sm font-medium">Description in Marathi</label>
                                    <textarea name="description_mr" id="description_mr" cols="20" rows="2" class="mt-2 w-full p-2 rounded-md focus:ring-0 text-sm resize-none  @if($errors->has('description_mr')) border-red-500 @endif" placeholder="Description in Marathi">{{ $translations['mr']->description }}</textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="w-full">
                            <div class="mt-2">
                                <label for="image" class="text-sm font-medium">
                                    <span class="text-red">*</span> Attach Image
                                </label>
                                <div class="mt-2 max-w-[15rem] max-h-[11rem] p-2 border border-dashed border-black rounded-md">
                                    <div>
                                        <img id="preview-image" class="border border-primary rounded-md max-w-[16rem] p-2 max-h-[10rem] m-auto"
                                            src="{{ $packages->image ? asset('package_images/' . $packages->image) : asset('images/choose-file.png') }}" alt="Image">
                                    </div>
                                    <div id="image-name" class="text-sm text-center mt-1 font-bold text-gray-700">
                                        {{ $packages->image ? $packages->image : 'No image available' }}
                                    </div>
                                    <label for="file" class="bg-primary relative left-[2.5rem] top-[-6.2rem] bg-light text-white text-sm px-2 py-1.5 rounded-md ml-5">
                                        Choose File
                                    </label>
                                    <input type="file" name="image" id="file" class="hidden" placeholder="Price" onchange="previewImage(event, 'preview-image')">
                                </div>
                                @error('image')
                                    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="mt-4 border-t pt-4">
                        <button class="bg-red px-4 py-1 text-sm rounded-[0.2rem] text-white">Cancel</button>
                        <button class="bg-green px-4 py-1 text-sm rounded-[0.2rem] text-white">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
