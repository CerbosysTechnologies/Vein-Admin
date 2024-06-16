@extends('admin.layouts.app')
@section('content')
<div class="main md:mt-0 mt-6">
    <div class="relative overflow-hidden md:text-md text-lg">
      <div class="bg-white p-4 mt-2">
        <div class="flex items-center w-full">
          <h1 class="font-medium text-xl m-0 text-primary whitespace-nowrap mr-2">Update Test</h1>
          <div class="flex items-center w-full mt-[2px]">
            <i class="fa-solid fa-diamond text-primary text-[0.5rem]"></i>
            <div class="w-full border-t border-primary"></div>
          </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a class="bg-primary px-4 py-1 text-sm rounded-[0.2rem] text-white" href="{{ route('admin.test.index') }}">Back</a>
        <form action="{{ route('admin.test.update', $tests->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="shadow-md mt-4 p-2 pb-10">
                <div class="m-5 flex flex-wrap sm:flex-nowrap gap-4">
                    <div class="w-full">
                        <div class="{{ $errors->has('name_en') ? 'border-red-500' : '' }}">
                            <label for="name_en" class="text-sm font-medium">
                                <span class="text-red">*</span>Name in English
                            </label>
                            <input type="text" name="name_en" id="name_en" class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('name_en')) border-red-500 @endif" placeholder="Test Name in English"  value="{{ $testTranslationEn->test_name }}">
                            @error('name_en')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="w-full">
                        <div class="{{ $errors->has('name_hi') ? 'border-red-500' : '' }}">
                            <label for="name_hi" class="text-sm font-medium">
                                <span class="text-red">*</span>Name in Hindi</label>
                            <input type="text" name="name_hi" id="name_hi" class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('name_hi')) border-red-500 @endif" value="{{ $testTranslationHi->test_name}}" placeholder="Test Name in Hindi" >
                            @error('name_hi')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="w-full">
                        <div class="{{ $errors->has('name_mr') ? 'border-red-500' : '' }}">
                            <label for="name_mr" class="text-sm font-medium">
                                <span class="text-red">*</span>Name in Marathi</label>
                            <input type="text" name="name_mr" id="name_mr" class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('name_mr')) border-red-500 @endif" value="{{ $testTranslationMr->test_name }}" placeholder="Test Name in Marathi" >
                            @error('name_mr')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  </div>
                    <div class="m-5 flex flex-wrap sm:flex-nowrap gap-4">
                        <div class="w-full">
                            <div>
                                <label for="description_en" class="text-sm font-medium">
                                    <span class="text-red">*</span>Description in English</label>
                                <textarea name="description_en" id="description_en" cols="20" rows="2" class="mt-2 w-full p-2 rounded-md focus:ring-0 text-sm resize-none" placeholder="Description in English">{{ $testTranslationEn->description}}</textarea>
                            </div>
                        </div>
                        <div class="w-full">
                            <div>
                                <label for="description_hi" class="text-sm font-medium">
                                    <span class="text-red">*</span>Description in Hindi</label>
                                <textarea name="description_hi" id="description_hi" cols="20" rows="2" class="mt-2 w-full p-2 rounded-md focus:ring-0 text-sm resize-none" placeholder="Description in Hindi">{{ $testTranslationHi->description}}</textarea>
                            </div>
                        </div>
                        <div class="w-full">
                            <div>
                                <label for="description_mr" class="text-sm font-medium">
                                    <span class="text-red">*</span>Description in Marathi</label>
                                <textarea name="description_mr" id="description_mr" cols="20" rows="2" class="mt-2 w-full p-2 rounded-md focus:ring-0 text-sm resize-none" placeholder="Description in Marathi">{{ $testTranslationMr->description}}</textarea>
                            </div>
                        </div>
                    </div>
                <div class="m-5 flex flex-wrap sm:flex-nowrap  gap-10">
                    <div class="w-full">
                        <div class="mt-2 {{ $errors->has('price') ? 'border-red-500' : '' }}">
                            <label for="test_name" class="text-sm font-medium">
                                <span class="text-red">*</span> price </label>
                            <input type="text" name="price" id=""
                                class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm " placeholder="Price" value="{{ $tests->price}}" >
                            @error('price')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
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
                                        src="{{ $tests->images ? asset('test_images/' . $tests->images) : asset('images/choose-file.png') }}"
                                        alt="Image">
                                </div>
                                <div id="image-name" class="text-sm text-center mt-1 font-bold text-gray-700">
                                    {{ $tests->images ? $tests->images : 'No image available' }}
                                </div>
                                <label for="file" class="bg-primary relative left-[2.5rem] top-[-6.2rem] bg-light text-white text-sm px-2 py-1.5 rounded-md ml-5">
                                    Choose File
                                </label>
                                <input type="file" name="images" id="file" class="hidden" onchange="previewImage(event, 'preview-image')">
                            </div>
                            @error('images')
                            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="mt-4 border-t pt-4">
                <a class="bg-red px-4 py-1 text-sm rounded-[0.2rem] text-white" href="{{ route('admin.test.index') }}">Cancel</a>
                <button class="bg-green px-4 py-1 text-sm rounded-[0.2rem] text-white" type="submit">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>



  



@endsection


