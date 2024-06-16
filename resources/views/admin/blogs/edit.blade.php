@extends('admin.layouts.app')
@section('content')
<div class="main md:mt-0 mt-6">
    <div class="relative overflow-hidden md:text-md text-lg">
        <div class="bg-white p-4 mt-2">
            <div class="flex items-center w-full">
                <h1 class="font-medium text-xl m-0 text-primary whitespace-nowrap mr-2">Edit Blog</h1>
                <div class="flex items-center w-full mt-[2px]">
                    <i class="fa-solid fa-diamond text-primary text-[0.5rem]"></i>
                    <div class="w-full border-t border-primary"></div>
                </div>
            </div>
            <form action="{{ route('admin.blog.update', $blog->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="shadow-md mt-4 mb-4 p-2">
                    <div class="mt-2 flex flex-wrap sm:flex-nowrap gap-4">
                        <div class="w-full">
                            <div>
                                <label for="title" class="text-sm font-medium">
                                    <span class="text-red">*</span>Blog Title
                                </label>
                                <input type="text" name="title" id="title" class="mt-2 w-full h-10 p-2 rounded-md focus:ring-0 text-sm" value="{{ $blog->title }}" placeholder="Title">
                            </div>
                        </div>
                    </div>
                </div>
                <label for="description" class="text-sm font-medium">
                    <span class="text-red">*</span>Blog Description
                </label>
                <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
                <textarea name="description" id="editor" cols="30" rows="10" class="description editor">{{ $blog->description }}</textarea>
                <div>
                    <label for="featured_image" class="text-sm font-medium">
                        <span class="text-red">*</span>Featured Image
                    </label>
                    <input type="file" name="featured_image" id="featured_image" accept="image/png, image/jpeg" class="border border-gray-600 rounded-md text-sm mt-2 ">
                    <img id="featured_image_preview" src="{{ asset('featured_images/'.$blog->featured_image) }}" style="height: 100px; width: auto;" >
                </div>
                <div>
                    <label for="other_images" class="text-sm font-medium">
                        <span class="text-red">*</span>Other Images
                    </label>
                    <input type="file" name="other_images[]" id="other_images" accept="image/png, image/jpeg" multiple class="mt-2 border border-gray-600 rounded-md text-sm ">
                    <p class="text-sm font-medium pl-24 pt-2">Uploaded max images to 4.</p>
                    <div id="other_images_preview" class="image-preview-container">
                        @foreach($blog_images as $image)
                            <img src="{{ asset('blog_images/' . $image) }}" alt="Image">
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-4 border-t pt-4 text-end">
                    <button type="submit" id="updateButton" class="bg-primary px-6 py-2.5 text-sm rounded-[0.2rem] text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
