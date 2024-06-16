@extends('admin.layouts.app')
@section('content')
    <div class="main md:mt-0 mt-6">
      <div class="relative overflow-hidden md:text-md text-lg">
        <div class="bg-white p-4 mt-2">
          <div class="flex justify-between items-center pr-2">
            <div>
              <h1 class="font-medium text-xl m-0">Lab</h1>
            </div>
            <!-- <div>
              <a href="./add-appointmnet.html">
                <button class="bg-primary text-white rounded-md  py-2 px-3 text-sm">+ New Appointment</button>
              </a>
            </div> -->
          </div>
          <div class="shadow-lg p-2 mt-2">
            <div class="flex justify-between  items-center icon-bar">
              <div class="flex items-center ">
                <select name="" id="" class=" text-sm focus:ring-0 p-1 rounded-sm">
                  <option value="">25</option>
                  <option value="">26</option>
                </select>
              </div>
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
                    <th class="px-4 font-semibold p-2.5">Action</th>
                    <th class="px-4 font-semibold">Name</th>
                    <th class="px-4 font-semibold">Contact</th>
                    <th class="px-4 font-semibold">Email</th>
                    <th class="px-4 font-semibold">Date</th>
                    <th class="px-4 font-semibold ">Time</th>
                    <th class="px-4 font-semibold">Status</th>
                    <th class="px-4 font-semibold rounded-tr-md">Address</th>
                    <th class="px-4 font-semibold rounded-tr-md"> Appointment Type </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center text-[0.8rem]">
                    <td class="p-4">1</td>
                      <td>
                       <select id="countries" class="mt-2 w-full h-8 pl-2 rounded-md focus:ring-0 text-sm" >
                  
                        <option value="US">Accept</option>
                        <option value="CA">Reschedule</option>
                        <option value="CA">Reject</option>
                        <option value="CA">Complete</option>
                      </select>
                    </td>
                    <td>Harshita</td>
                    <td>6266457895</td>
                    <td>text@gmail.com</td>
                    <td>20-10-23</td>
                    <td>22:02</td>
                    <td>
                      <span class="bg-lightgreen text-green p-1 rounded-[0.2rem]">Complete</span>
                    </td>
                    <td>----------------</td>
                    <td>Lab</td>
                  </tr>
                  <tr class="text-center text-[0.8rem]">
                    <td class="p-4 ">2</td>
                      <td>
                       <select id="countries" class="mt-2 w-full h-8 pl-2 rounded-md focus:ring-0 text-sm" >
                  
                        <option value="US">Accept</option>
                        <option value="CA">Reschedule</option>
                        <option value="CA">Reject</option>
                        <option value="CA">Complete</option>
                      </select>
                    </td>
                    <td class="">Harshita</td>
                    <td>6266457895</td>
                    <td>text@gmail.com</td>
                    <td class="">20-10-23</td>
                    <td class="">22:02</td>
                    <td>
                      <span class="bg-light_blue text-blue w-4 p-1 px-2 rounded-[0.2rem]">Pending</span>
                    </td>
                    <td>----------------</td>
                    <td>Lab</td>
                  </tr>
                  <tr class="text-center text-[0.8rem]">
                    <td class="p-4 ">3</td>
                    <td>
                       <select id="countries" class="mt-2 w-full h-8 pl-2 rounded-md focus:ring-0 text-sm" >
                  
                        <option value="US">Accept</option>
                        <option value="CA">Reschedule</option>
                        <option value="CA">Reject</option>
                        <option value="CA">Complete</option>
                      </select>
                    </td>
                    <td class="">Harshita</td>
                    <td>6266457895</td>
                    <td>text@gmail.com</td>
                    <td class="">20-10-23</td>
                    <td class="">22:02</td>
                    <td>
                      <span class="bg-lightred text-red p-1 px-3 rounded-[0.2rem]">Cancel</span>
                    </td>
                    <td>----------------</td>
                    <td>Lab</td>
                  </tr>
                  <tr class="text-center text-[0.8rem]">
                    <td class="p-4 ">4</td>
                      <td>
                      <select id="countries" class="mt-2 w-full h-8 pl-2 rounded-md focus:ring-0 text-sm" >
                  
                        <option value="US">Accept</option>
                        <option value="CA">Reschedule</option>
                        <option value="CA">Reject</option>
                        <option value="CA">Complete</option>
                      </select>
                    </td>
                    <td class="">Harshita</td>
                    <td>6266457895</td>
                    <td>text@gmail.com</td>
                    <td class="">20-10-23</td>
                    <td class="">22:02</td>
                    <td>
                      <span class="bg-lightgreen text-green p-1 rounded-[0.2rem]">Complete</span>
                    </td>
                    <td>----------------</td>
                    <td>Lab</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- only for  start -->

@endsection