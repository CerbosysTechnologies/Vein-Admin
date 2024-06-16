@extends('admin.layouts.app')
@section('content')
<div class="main md:mt-0 mt-6">
    <div class="relative overflow-hidden md:text-md text-lg">
      <div class="bg-white p-4 mt-2">
        <div class="flex items-center w-full">
          <h1 class="font-medium text-xl m-0 text-primary whitespace-nowrap mr-2">Edit Slot</h1>
          <div class="flex items-center w-full mt-[2px]">
            <i class="fa-solid fa-diamond text-primary text-[0.5rem]"></i>
            <div class="w-full border-t border-primary"></div>
          </div>
        </div>
        <div class="shadow-md mt-4 p-2">
          <div class="flex flex-wrap sm:flex-nowrap  gap-10">
            <div class="w-full">
              <form action="{{ route('admin.slot.update', ['slot' => $slot->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="appointment_type" class="text-sm font-medium">
                        <span class="text-red">*</span> Appointment Type
                    </label>
                    <select name="appointment_type" id="appointment_type" class="mt-2 w-full h-8 px-2 rounded-md focus:ring-0 text-sm">
                        <option value="home" {{ $slot->type == 'home' ? 'selected' : '' }}>Home</option>
                        <option value="lab" {{ $slot->type == 'lab' ? 'selected' : '' }}>Lab</option>
                    </select>
                    @error('appointment_type')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div id="time_slots_div">
                    <label for="slot_time" class="text-sm font-medium">
                        <span class="text-red">*</span> Slot Time
                    </label>
                    <select name="slot_time" id="slot_time" class="mt-2 w-full h-8 px-2 rounded-md focus:ring-0 text-sm" placeholder="Time">
                        <option value="{{ $startEndTime }}" {{ $startEndTime == $slot->start_time . ' to ' . $slot->end_time ? 'selected' : '' }}>{{ $startEndTime }}</option>
                        <!-- The initial option will be replaced by JavaScript -->
                    </select>
                    
                    @error('slot_time')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4 border-t pt-4">
                    <button type="button" onclick="window.location.href = '{{ route('admin.slot.index') }}'" class="bg-red px-4 py-1 text-sm rounded-[0.2rem] text-white">Cancel</button>
                    <button type="submit" class="bg-green px-4 py-1 text-sm rounded-[0.2rem] text-white">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
