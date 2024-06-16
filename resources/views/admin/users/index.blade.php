@extends('admin.layouts.app')
@section('content')
<div class="main md:mt-0 mt-6">
    <div class="relative overflow-hidden md:text-md text-lg">
      <div class="bg-white p-4 mt-2">
        <div class="flex justify-between items-center pr-2">
          <div>
            <h1 class="font-medium text-xl m-0">Users</h1>
          </div>
          <!-- <div>
            <a href="./add-user.html">
              <button class="bg-primary text-white rounded-md  py-2 px-3 text-sm">+ New User</button>
            </a>
          </div> -->
        </div>
        <div class="shadow-lg p-2 mt-2">
          <div class="flex justify-between  items-center icon-bar">
            <div class="">
              <input type="search" placeholder="Search" class="w-24 sm:w-auto  focus:ring-0 focus:outline-none rounded h-8 text-xs">
              <button class="bg-primary text-white rounded-r-md  py-[5.8px] px-3 text-sm relative top-[1px] left-[-12px]">Search</button>
            </div>
          </div>
          <div class="mt-4 shadow-md rounded-md overflow-auto">
            <table class="w-full rounded-md">
              <thead class="bg-light_blue rounded-md">
                <tr class="p-2 rounded-md font-semibold text-[0.9rem] whitespace-nowrap">
                  <th class="px-4 font-semibold p-1 rounded-tl-xl">S. No.</th>
                
                  <th class="px-4 font-semibold">Name</th>
                  <th class="px-4 font-semibold">Email</th>
                  <th class="px-4 font-semibold">Image</th>
                  <th class="px-4 font-semibold">Contact</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                @foreach ($users as $user)
                    <tr class="text-center text-[0.8rem]">
                    <td class="p-4">{{ $i }}</td>
                    <td class="text-sm">{{ $user->name }}</td>
                    <td class="text-sm">{{ $user->email }}</td>
                    <td>
                        <img src="{{ asset('images/ratlami-sev.png') }}" alt="" class="w-8 m-auto">
                    </td>
                    <td class="text-sm">{{ $user->contact }}</td>
                    </tr>
                <?php $i++;?>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- text section end -->
    </div>
</div>
@endsection