@extends('admin.layouts.app')
@section('content')
<div class="main md:mt-0 mt-6">
    <div class="relative overflow-hidden md:text-md text-lg">
        <div class="bg-white p-4 mt-2">
            <div class="flex justify-between items-center pr-2">
                <div>
                    <h1 class="font-medium text-xl m-0">All Franchises</h1>
                </div>
            </div>

            <div class="mt-4 shadow-md rounded-md overflow-auto">
                <table class="w-full rounded-md mt-4 ">
                    <thead class="bg-light_blue  rounded-md">
                        <tr class="p-2 rounded-md font-semibold text-[0.9rem] whitespace-nowrap">
                            <th class="px-4 font-semibold p-1 rounded-tl-xl ">S. No.</th>
                            <th class="px-4 font-semibold">Name</th>
                            <th class="px-4 font-semibold">Email</th>
                            <th class="px-4 font-semibold">Phone</th>
                            <th class="px-4 font-semibold">Address</th>
                            <th class="px-4 font-semibold">Description</th>
                    </thead>
                    <tbody>
                        @foreach ($inquiries as $key => $franchise)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $franchise->first_name }}</td>
                            <td class="text-center">{{ $franchise->email }}</td>
                            <td class="text-center">{{ $franchise->mobile }}</td>
                            <td class="text-center">{{ $franchise->location }}</td>
                            <td class="text-center">{{ $franchise->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>


@endsection
