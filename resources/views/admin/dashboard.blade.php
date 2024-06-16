
@extends('admin.layouts.app')

@section('content')
    <div class="main md:mt-0 mt-6">
        <div class="relative overflow-hidden md:text-md text-lg">
        <div class="bg-white p-4 mt-4">
            <h4 class="font-semibold text-primary w-fit md:text-start text-xl">
            <!-- <p class="w-fit md:text-start text-xl  font-bold text-center"> --> Dashboard
            </h4>
            <!-- card section start -->
            <div>
            <div class="rounded-lg grow md:justify-between justify-center flex lg:flex-row flex-wrap gap-2 mt-4">
                <!-- card 1 -->
                <div class="shadow-md shadow-grey rounded-lg p-8 mt-2">
                <div class="flex justify-between w-full grow gap-10 items-center">
                    <div class="w-[30%]">
                    <img src="{{ asset('images/card1.png') }}" alt="img" class="w-[80px]" />
                    </div>
                    <div class="w-[70%]">
                    <p class="text-primary font-bold text-lg w-fit"> Pending Order </p>
                    <p class="text-black font-bold text-md w-fit">20</p>
                    </div>
                </div>
                </div>
                <!-- card 2 -->
                <div class="shadow-md shadow-grey rounded-lg p-8 mt-2">
                <div class="flex w-full justify-between grow gap-10 items-center">
                    <div class="w-[30%]">
                    <img src="{{ asset('images/card2.png') }}" alt="img" class="w-[80px]" />
                    </div>
                    <div class="w-[70%]">
                    <p class="text-primary font-bold text-lg w-fit"> Total Orders </p>
                    <p class="text-black font-bold text-md w-fit">20</p>
                    </div>
                </div>
                </div>
                <!-- card 3 -->
                <div class="shadow-md shadow-grey rounded-lg p-8 mt-2">
                <div class="flex w-full justify-between gap-10 grow items-center">
                    <div class="w-[30%]">
                    <img src="{{ asset('images/card3.png')}}" alt="img" class="w-[80px]" />
                    </div>
                    <div class="w-[70%]">
                    <p class="text-primary font-bold text-lg w-fit"> Monthly Sale </p>
                    <p class="text-black font-bold text-md w-fit">20</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- card section end -->
            <!--table section start-->
            <div class="shadow-lg p-2 mt-2">
            <div class="mt-4 shadow-md rounded-md overflow-x-scroll">
                <table class="w-full rounded-md">
                <thead class="bg-light_blue rounded-md whitespace-nowrap">
                    <tr class="p-2 rounded-md font-semibold text-[0.9rem]">
                    <th class="font-semibold p-1 rounded-tl-xl">S. No.</th>
                    <th class="font-semibold px-4">Name</th>
                    <th class="font-semibold px-4">image</th>
                    <th class="font-semibold px-4">Description</th>
                    <th class="font-semibold px-4">Total Test Included</th>
                    <th class="font-semibold rounded-tr-md px-4">Charges</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center text-[0.8rem]">
                    <td class="p-4">1</td>
                    <td>Harshita</td>
                    <td>
                        <img src="{{ asset('images/ratlami-sev.png')}}" alt="" class="w-8 m-auto">
                    </td>
                    <td>--------------</td>
                    <td>345</td>
                    <td>12345$</td>
                    </tr>
                    <tr class="text-center">
                    <td class="p-4 text-sm">1</td>
                    <td class="text-sm">Harshita</td>
                    <td>
                        <img src="{{ asset('images/ratlami-sev.png')}}" alt="" class="w-8 m-auto">
                    </td>
                    <td class="text-sm">--------------</td>
                    <td class="text-sm">345</td>
                    <td class="text-sm">12345$</td>
                    </tr>
                    <tr class="text-center">
                    <td class="p-4 text-sm">1</td>
                    <td class="text-sm">Harshita</td>
                    <td>
                        <img src="{{ asset('images/ratlami-sev.png')}}" alt="" class="w-8 m-auto">
                    </td>
                    <td class="text-sm">--------------</td>
                    <td class="text-sm">345</td>
                    <td class="text-sm">12345$</td>
                    </tr>
                    <tr class="text-center">
                    <td class="p-4 text-sm">1</td>
                    <td class="text-sm">Harshita</td>
                    <td>
                        <img src="{{ asset('images/ratlami-sev.png')}}" alt="" class="w-8 m-auto">
                    </td>
                    <td class="text-sm">--------------</td>
                    <td class="text-sm">345</td>
                    <td class="text-sm">12345$</td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
            <!--end table section-->
            <!-- dashboard section end -->
        </div>
        </div>
    </div>




   
@endsection