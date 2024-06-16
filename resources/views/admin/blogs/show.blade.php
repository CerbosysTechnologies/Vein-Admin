@extends('admin.layouts.app')
@section('content')
    <div class="max-w-4xl mx-auto shadow-xl mt-20 rounded-md">
        <h1 class="text-3xl font-bold mb-4">{{ $blog->title }}</h1>
        {{-- @if ($blog->featured_image) --}}
        <img src="{{ asset('featured_images/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="mb-4 w-full">
        {{-- @endif --}}
        <div class="text-lg mb-4">{!! $blog->description !!}</div>
    </div>

@endsection