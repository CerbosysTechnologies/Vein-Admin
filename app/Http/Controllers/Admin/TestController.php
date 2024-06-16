<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestTranslation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\TestFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class TestController extends Controller
{
    public function index()
    {
        $tests = DB::table("tests")
                ->select('tests.id', 'tests.price', 'tests.images', 'test_translation.test_name')
                ->join('test_translation', 'tests.id', '=', 'test_translation.test_id')
                ->where('test_translation.language_id', 'en')
                ->orderBy('tests.id')
                ->paginate(25);

        return view('admin.tests.index', compact('tests'));

    }

    public function create()
    {
        // Return view for creating a new package
        return view('admin.tests.create');
    }

    public function store(TestFormRequest $request)
    {
        // Validate form data
       $validatedData = $request->validated();
         // Handle file upload
         if ($request->hasFile('images')) {
            $file = $request->file('images');
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->move(public_path('test_images'), $fileName);
            } else {
                return back()->with('error', 'Invalid file');
            }
        } else {
            return back()->with('error', 'File not found');
        }

        // Create new test
        $test = new Test();
        $test->price = $validatedData['price'];
        $test->images = $fileName;
        $test->save();

         // Create test translations
        $testTranslationEn = new TestTranslation();
        $testTranslationEn->test_id = $test->id;
        $testTranslationEn->language_id = 'en';
        $testTranslationEn->test_name = $validatedData['name_en'];
        $testTranslationEn->description = $request->input('description_en');
        $testTranslationEn->save();

        $testTranslationHi = new TestTranslation();
        $testTranslationHi->test_id = $test->id;
        $testTranslationHi->language_id = 'hi';
        $testTranslationHi->test_name = $validatedData['name_hi'];
        $testTranslationHi->description = $request->input('description_hi');  
        $testTranslationHi->save();

        $testTranslationMr = new TestTranslation();
        $testTranslationMr->test_id = $test->id;
        $testTranslationMr->language_id = 'mr';
        $testTranslationMr->test_name = $validatedData['name_mr'];
        $testTranslationMr->description = $request->input('description_mr');
        $testTranslationMr->save();

         // Flash message
        $request->session()->flash('success', 'Test stored successfully.');

        // Redirect with a delay
        return redirect()->route('admin.test.index')->with('delay', true);
    }

    public function edit($id)
    {
        // Fetch test data
        $tests = Test::findOrFail($id);
        // Fetch test translations
        $testTranslationEn = TestTranslation::where('test_id', $id)->where('language_id', 'en')->first();
        $testTranslationHi = TestTranslation::where('test_id', $id)->where('language_id', 'hi')->first();
        $testTranslationMr = TestTranslation::where('test_id', $id)->where('language_id', 'mr')->first();

        return view('admin.tests.edit', compact('tests', 'testTranslationEn', 'testTranslationHi', 'testTranslationMr'));
    }

    public function update(TestFormRequest $request, $id)
    {
        // Validate form data
        $validatedData = $request->validated();
    
        $test = Test::findOrFail($id);
    
        // Handle file upload
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->move(public_path('test_images'), $fileName);
                $test->images = $fileName; // Update image filename in the database
            } else {
                return back()->with('error', 'Invalid file');
            }
        }
    
        // Update other test details
        $test->price = $request->input('price');
        $test->save();

        // Update test translations
        $testTranslationEn = $test->translations()->where('language_id', 'en')->first();
        $testTranslationEn->test_name =  $validatedData['name_en'];
        $testTranslationEn->save();

        $testTranslationHi = $test->translations()->where('language_id', 'hi')->first();
        $testTranslationHi->test_name =  $validatedData['name_hi'];
        $testTranslationHi->save();

        $testTranslationMr = $test->translations()->where('language_id', 'mr')->first();
        $testTranslationMr->test_name =  $validatedData['name_mr'];
        $testTranslationMr->save();

       // Flash message
        $request->session()->flash('success', 'Test updated successfully.');

        // Redirect with a delay
        return redirect()->route('admin.test.index')->with('delay', true);
    }

    public function destroy($id)
    {
        try {
            $test = Test::findOrFail($id);
            
            // Delete translations associated with the test
            TestTranslation::where('test_id', $id)->delete();
            
            // Then delete the test itself
            $test->delete();
            Session::flash('success', 'Test and its translations deleted successfully');
            return response()->json(['message' => 'Test and its translations deleted successfully']);
        } 
        catch (ModelNotFoundException $exception) {
            Session::flash('error', 'Test not found');
            return response()->json(['error' => 'Test not found'], 404);
        }
    }
}