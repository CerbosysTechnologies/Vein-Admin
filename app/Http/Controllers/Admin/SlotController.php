<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slots = Slot::paginate(10);
        return view('admin.slots.index', compact('slots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'slot_time' => 'required',
            'appointment_type' => 'required',
        ]);


        // Extract start time and end time from slot_time
        $slotStartTime = date('H:i', strtotime($request->slot_time));
        $slotEndTime = date('H:i', strtotime($request->slot_time . ' +1 hour'));

        // Create a new slot instance
        $slot = new Slot();
        $slot->start_time = $slotStartTime;
        $slot->end_time = $slotEndTime;
        $slot->type = $request->appointment_type;
        $slot->save();

        // Redirect back with success message
        return redirect()->route('admin.slot.index')->with('success', 'Slot added successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $slot = Slot::findOrFail($id);
            $startEndTime = $slot->start_time . ' to ' . $slot->end_time;
            dd($startEndTime);
            return view('admin.slots.edit', compact('slot', 'startEndTime'));
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Slot not found'], 404);
        }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'slot_time' => 'required',
        ]);
    
        // Find the slot by ID
        $slot = Slot::findOrFail($id);
    
        // Convert slot time to the correct format
        $startTime = date('H', strtotime($request->slot_time));
    
        // Update slot data
        $slot->start_time = $startTime;
        $slot->end_time = date('H', strtotime($startTime . ' +1 hour')); // Assuming end time is 1 hour after start time
        $slot->type = $request->appointment_type;
        $slot->save();
    
        // Redirect back with success message
        return redirect()->route('admin.slot.index')->with('success', 'Slot updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $slot = Slot::findOrFail($id); 
    
            // Delete slot
            $slot->delete(); 
    
            return response()->json(['message' => 'Slot deleted successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Slot not found'], 404);
        }
    }

    public function updateStatus(Request $request, $slotId) {
        // Retrieve the slot from the database
        $slot = Slot::find($slotId);
    
        // Update the status based on the user's selection
        $slot->active = $request->input('active');
    
        // Save the updated slot
        $slot->save();
    
        // Redirect back or return a response as needed
        return redirect()->back()->with('success', 'Status updated successfully');
    }
}
