<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageFormRequest;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Test;
use App\Models\Package_Test;
use App\Models\TestTranslation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        $packages = DB::table("packages")
                    ->select('packages.id', 'packages.price','package_translation.package_name', 'package_translation.description','packages.image','packages.total_test_included')
                    ->join('package_translation','packages.id', '=', 'package_translation.package_id')
                            ->where('package_translation.language_id', '=', 'en')
                            ->orderBy('packages.id')
                    ->paginate(25);
        $tests = Test::all();
        return view('admin.packages.index', compact('packages','tests'));
    }

    public function create()
    {
        // Return view for creating a new package
        $tests = TestTranslation::join('tests', 'tests.id', '=', 'test_translation.test_id')
        ->where('test_translation.language_id', 'en')
        ->select('tests.id', 'test_translation.test_name', 'tests.price') 
        ->get();
    
        return view('admin.packages.create', compact('tests'));
    }

    public function store(PackageFormRequest $request)
    {
        // Validate form data
        $validatedData = $request->validated();
        
        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->move(public_path('package_images'), $fileName);
            } else {
                return back()->with('error', 'Invalid file');
            }
        } else {
            return back()->with('error', 'File not found');
        }
    
        // Create new package
        $package = new Package();
        $package->total_test_included = $validatedData['total_test_included'];
        $package->price = $validatedData['price'];
        $package->image = $fileName;
        $package->save();
        $packageId = $package->id;
        // Save package name translations
        $package->translations()->createMany([
            ['language_id' => 'en', 'package_name' => $validatedData['name_en'], 'description' => $request->input('description_en')],
            ['language_id' => 'hi', 'package_name' => $validatedData['name_hi'], 'description' => $request->input('description_hi') ?? NULL],
            ['language_id' => 'mr', 'package_name' => $validatedData['name_mr'], 'description' => $request->input('description_mr')  ?? NULL],
        ]);
        
        // Save selected tests
        $selectedTests = $validatedData['selected_tests'];
        foreach ($selectedTests as $testId) {
            DB::table('package_tests')->insert([
                'package_id' => $packageId,
                'test_id' => $testId,
            ]);
        }
        
    
        return redirect()->route('admin.package.index')->with('success', 'Package created successfully.');
    }
    

    public function show($id)
    {
        // Return view for showing a specific package
    }

    public function edit($id)
    {
        $packages = Package::with('tests')->findOrFail($id);
        $packageTests = $packages->tests()->pluck('test_id')->toArray();
    
        $tests = DB::table('package_tests')
                    ->select('tests.id', 'test_translation.test_name', 'test_translation.description', 'tests.price')
                    ->join('tests', 'tests.id', '=', 'package_tests.test_id')
                    ->join('test_translation', 'test_translation.test_id', '=', 'tests.id')
                    ->where('test_translation.language_id', '=', 'en')
                    ->where('package_tests.package_id', '=', $id)
                    ->get();
    
        $alltests = DB::table('tests')
        ->select('tests.id','test_translation.test_name','test_translation.description','tests.price')
        ->join('test_translation','test_translation.test_id','=','tests.id')
        ->where('test_translation.language_id', '=', 'en')->get();

        $translations = $packages->translations()->get()->keyBy('language_id');
        return view('admin.packages.edit', compact('packages', 'tests', 'translations', 'packageTests', 'alltests'));
    }
    
    

    public function update(PackageFormRequest $request, $id)
    {
        $validatedData = $request->validated();
    
        $packages = Package::findOrFail($id);
    
        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->move(public_path('package_images'), $fileName);
            } else {
                return back()->with('error', 'Invalid file');
            }
        } else {
            return back()->with('error', 'File not found');
        }
    
        // Update packages fields
        $packages->total_test_included = $validatedData['total_test_included'];
        $packages->price = $validatedData['price'];
        $packages->image = $fileName;
        $packages->save();
    
        // Update packages name translations
        // Update packages name translations
        $packages->translations()->updateOrCreate(
            ['language_id' => 'en'], // Condition to match against existing records
            ['package_name' => $validatedData['name_en'], 'description' => $request->input('description_en')] // Values to update or create
        );
        $packages->translations()->updateOrCreate(
            ['language_id' => 'hi'],
            ['package_name' => $validatedData['name_hi'], 'description' => $request->input('description_hi') ?? NULL]
        );
        $packages->translations()->updateOrCreate(
            ['language_id' => 'mr'],
            ['package_name' => $validatedData['name_mr'], 'description' => $request->input('description_mr') ?? NULL]
        );

    
        // Update selected tests
        $selectedTests = $validatedData['selected_tests'];
        $packages->tests()->sync($selectedTests);
    
        return redirect()->route('admin.package.index')
                        ->with('success', 'Package updated successfully');
    }
    


    public function destroy($id)
    {
        try {
            $package = Package::findOrFail($id); 
    
            // Delete translations
            $package->translations()->delete();
    
            // Delete package
            $package->delete(); 
    
            return response()->json(['message' => 'Package deleted successfully']);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Package not found'], 404);
        }
    }
    
}
