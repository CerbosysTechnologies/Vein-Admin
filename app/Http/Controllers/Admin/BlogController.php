<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'asc')->get(); 
        return view('admin.blogs.index', compact('blogs'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image');
            $imageName = time() . '_' . $featuredImage->getClientOriginalName();

            $newimage = $featuredImage->move(public_path('featured_images'), $imageName);
            // dd($newimage);
            $blog->featured_image = $imageName;
        }

        // Handle other images upload
        $otherImages = [];
        if ($request->hasFile('other_images')) {
            foreach ($request->file('other_images') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('blog_images'), $imageName);
                $otherImages[] = $imageName;
            }
        }

        // Store other image paths in respective columns
        $blog->image1 = $otherImages[0] ?? null;
        $blog->image2 = $otherImages[1] ?? null;
        $blog->image3 = $otherImages[2] ?? null;
        $blog->image4 = $otherImages[3] ?? null;

        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully.');
    }

  
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        // Concatenate non-null values from image1, image2, image3, and image4 into a single array
        $blog_images = array_filter([$blog->image1, $blog->image2, $blog->image3, $blog->image4]);
        return view('admin.blogs.edit', compact('blog', 'blog_images'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->description = $request->description;

        // Handle featured image update
        if ($request->hasFile('featured_image')) {
            // Delete the existing featured image
            if ($blog->featured_image) {
                unlink(public_path('featured_images/' . $blog->featured_image));
            }
            // Upload the new featured image
            $featuredImage = $request->file('featured_image');
            $imageName = time() . '_' . $featuredImage->getClientOriginalName();
            $featuredImage->move(public_path('featured_images'), $imageName);
            $blog->featured_image = $imageName;
        }

        // Handle other images update
        $otherImages = [];
        if ($request->hasFile('other_images')) {
            foreach ($request->file('other_images') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('blog_images'), $imageName);
                $otherImages[] = $imageName;
            }
        }

        // Store other image paths in respective columns
        $blog->image1 = $otherImages[0] ?? null;
        $blog->image2 = $otherImages[1] ?? null;
        $blog->image3 = $otherImages[2] ?? null;
        $blog->image4 = $otherImages[3] ?? null;

        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            
            // Then delete the blog itself
            $blog->delete();
            Session::flash('success', 'Blog deleted successfully');
            return response()->json(['message' => 'Blog deleted successfully']);
        } 
        catch (ModelNotFoundException $exception) {
            Session::flash('error', 'Blog not found');
            return response()->json(['error' => 'Blog not found'], 404);
        }
    }
}
