@extends('admin.layouts.app')
@section('content')
    <div class="main md:mt-0 mt-6">
        <div class="relative overflow-hidden md:text-md text-lg">
            <div class="bg-white p-4 mt-2">
                <div class="flex items-center w-full">
                    <h1 class="font-medium text-xl m-0 text-primary whitespace-nowrap mr-2">Update Laboratory</h1>
                    <div class="flex items-center w-full mt-[2px]">
                        <i class="fa-solid fa-diamond text-primary text-[0.5rem]"></i>
                        <div class="w-full border-t border-primary"></div>
                    </div>
                </div>

                <a class="bg-primary px-4 py-1 text-sm rounded-[0.2rem] text-white" href="{{ route('admin.laboratory_location.index') }}">Back</a>
                <form action="{{ route('admin.laboratory_location.update', $laboratories->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="shadow-md mt-4 p-2 pb-10">
                        <div class="m-5 flex flex-wrap sm:flex-nowrap gap-4">
                            <div class="w-full">
                            <div class="mt-2 {{ $errors->has('name_en') ? 'border-red-500' : '' }}">
                                <label for="name_en" class="text-sm font-medium">
                                    <span class="text-red">*</span> Name</label>
                                <input type="text" name="name" id="name"
                                    class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('name')) border-red-500 @endif"
                                    placeholder="Name" value="{{ $laboratories->name }}">
                                @error('name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="w-full">
                                <div class="mt-2 {{ $errors->has('address') ? 'border-red-500' : '' }}">
                                    <label for="address" class="text-sm font-medium">
                                    <span class="text-red">*</span>Address</label>
                                    <input type="text" name="address" id="address"
                                        class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('address')) border-red-500 @endif"
                                        placeholder="Address" value="{{ $laboratories->address }}">
                                    @error('address')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       
                        <div class="m-5 flex flex-wrap sm:flex-nowrap gap-4">
                            <div class="w-full">
                            <div class="mt-2 {{ $errors->has('contact_person_name') ? 'border-red-500' : '' }}">
                                <label for="contact_person_name" class="text-sm font-medium">
                                <span class="text-red">*</span>Contact Person Name</label>
                                <input type="text" name="contact_person_name" id="contact_person_name"
                                    class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('contact_person_name')) border-red-500 @endif"
                                    placeholder="Contact Person" value="{{ $laboratories->contact_person_name }}">
                                @error('contact_person_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                            <div class="w-full">
                                <div class="mt-2 {{ $errors->has('contacts') ? 'border-red-500' : '' }}">
                                    <label for="contacts" class="text-sm font-medium">
                                        <span class="text-red">*</span> Contact
                                    </label>
                                    <input type="text" name="contacts" id="contacts" class="mt-2 w-full h-8 p-2 rounded-md focus:ring-0 text-sm @if($errors->has('contacts')) border-red-500 @endif" placeholder="Contact" value="{{ old('contacts', implode(', ', $laboratories->contacts)) }}">
                                    <p class="text-sm">Number should be in 10 digits.</p>
                                    @error('contacts')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="mt-2 {{ $errors->has('facility_type') ? 'border-red-500' : '' }}">
                                    <label for="facility_type" class="text-sm font-medium">
                                        <span class="text-red">*</span> Facility Type
                                    </label>
                                    <select name="facility_type" id="facility_type" class="mt-2 w-full h-8  px-2 py-1 rounded-md focus:ring-0 text-sm @if($errors->has('facility_type')) border-red-500 @endif">
                                        <option value="" disabled>Select Facility Type</option>
                                        <option value="Laboratory" @if($laboratories->facility_type == 'Laboratory') selected @endif> Laboratory</option>
                                        <option value="Collection Center" @if($laboratories->facility_type == 'Collection Center') selected @endif> Collection Center</option>
                                    </select>
                                    @error('facility_type')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
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
                                            src="{{ $laboratories->image ? asset('lab_images/' . $laboratories->image) : asset('images/choose-file.png') }}" alt="Lab Image">
                                    </div>
                                    <div id="image-name" class="text-sm text-center mt-1 font-bold text-gray-700">
                                        {{ $laboratories->image ? $laboratories->image : 'No image available' }}
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
                        <a class="bg-red px-4 py-1 text-sm rounded-[0.2rem] text-white">Cancel</a>
                        <button class="bg-green px-4 py-1 text-sm rounded-[0.2rem] text-white" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection