<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Laboratory;
use App\Models\Package;
use App\Models\PackageTranslation;
use App\Models\Slot;
use App\Models\Test;
use App\Models\TestTranslation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    use AuthorizesRequests {
        authorize as protected baseAuthorize;
    }

    public function authorize($ability, $arguments = []){
        if(Auth::guard('admin')->check()){
            Auth::shouldUse('admin');
        }

        $this->baseAuthorize($ability, $arguments);
    }

    public function search(Request $request)
    {
        $keyword = $request->get('q');
        
        $users = User::where('name', 'like', '%' . $keyword . '%')->get();
        $package = PackageTranslation::where('package_name', 'like', '%' . $keyword . '%')->get();
        $test = TestTranslation::where('test_name', 'like', '%' . $keyword . '%')->get();
        $lab = Laboratory::where('name', 'like', '%' . $keyword . '%')->get();
        $blog = Blog::where('title', 'like', '%' . $keyword . '%')->get();

        return response()->json([
            'users' => $users,
            'package' => $package,
            'test' => $test,
            'lab' => $lab,
            'blog' => $blog,
        ]);
    }


    public function index()
    {
        $adminData = $adminData = auth()->guard('admin')->user();
        return view('admin.myprofile', compact('adminData'));
    }
    
     // Method to update the profile
    public function update(Request $request)
    {
        $admin = auth()->guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,'.($admin ? $admin->id : null),
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact' => 'required|'
        ]);
        
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->contact = $request->contact;
        // Handle image upload
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = $admin->id . '_' . time() . '.' . $imageFile->getClientOriginalExtension();
            $imagePath = 'admin_images/';

            // Move uploaded file to the desired location
            $imageFile->move(public_path($imagePath), $imageName);

            // Update image path in the admin model
            $admin->image = $imagePath . $imageName;
        }


        // Update other fields as needed
        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

       
}
