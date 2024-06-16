<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Assuming you want to order laboratories by their ID in ascending order
        $laboratories = Laboratory::orderBy('id')->paginate(10);
        return view("admin.laboratory.index", compact("laboratories"));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.laboratory.create");
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'contacts' => 'required|nullable|string', 
            'contact_person_name' => 'required|string',
            'facility_type' => 'required|in:Laboratory,Collection Center',
        ]);

        // Extract and clean contact numbers from input
        $contacts = explode(" ", $validatedData['contacts']);
        $cleanedContacts = [];
        foreach ($contacts as $contact) {
            // Exclude country code and remove whitespace
            $cleanedContact = trim(str_replace('+91', '', $contact));
            if ($cleanedContact !== '') {
                $cleanedContacts[] = $cleanedContact;
            }
        }

        // Create a new laboratory instance
        $laboratory = new Laboratory();
        
        // Assign values from validated data to the model properties
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->move(public_path('lab_images'), $fileName);
            } else {
                return back()->with('error', 'Invalid file');
            }
        } else {
            return back()->with('error', 'File not found');
        }
        $laboratory->name = $validatedData['name'];
        $laboratory->address = $validatedData['address'];
        $laboratory->contacts = json_encode($cleanedContacts); 
        $laboratory->contact_person_name = $validatedData['contact_person_name'];
        $laboratory->facility_type = $validatedData['facility_type'];
        $laboratory->image = $fileName;


        // Save the laboratory to the database
        $laboratory->save();
    
        // Redirect to a specific route upon successful save
        return redirect()->route('admin.laboratory_location.index')->with('success', 'Laboratory created successfully');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laboratories = Laboratory::findOrFail($id);

            // Split concatenated phone numbers into an array
            $laboratories->contacts = json_decode($laboratories->contacts);

            return view('admin.laboratory.edit', compact('laboratories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'contacts' => 'nullable|string', 
            'contact_person_name' => 'required|string',
            'facility_type' => 'required|in:Laboratory,Collection Center',
        ]);

        $laboratory = Laboratory::findOrFail($id);
        $contacts = explode(" ", $validatedData['contacts']);
        $cleanedContacts = [];
        foreach ($contacts as $contact) {
            $cleanedContact = trim(str_replace('+91', '', $contact));
            if ($cleanedContact !== '') {
                $cleanedContacts[] = $cleanedContact;
            }
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->move(public_path('lab_images'), $fileName);
            } else {
                return back()->with('error', 'Invalid file');
            }
        } else {
            return back()->with('error', 'File not found');
        }
        // Update laboratory data
        $laboratory->name = $validatedData['name'];
        $laboratory->address = $validatedData['address'];
        $laboratory->contact_person_name = $validatedData['contact_person_name'];
        $laboratory->contacts = json_encode($cleanedContacts); 
        $laboratory->facility_type = $validatedData['facility_type'];
        $laboratory->image = $fileName;

        // Save the updated laboratory
        $laboratory->update();

        // Redirect to a specific route upon successful update
        return redirect()->route('admin.laboratory_location.index')->with('success', 'Laboratory Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $test = Laboratory::findOrFail($id);
            
            // Then delete the test itself
            $test->delete();
            Session::flash('success', 'Laboratory deleted successfully');
            return response()->json(['message' => 'Laboratory deleted successfully']);
        } 
        catch (ModelNotFoundException $exception) {
            Session::flash('error', 'Laboratory not found');
            return response()->json(['error' => 'Laboratory not found'], 404);
        }
    }
}
