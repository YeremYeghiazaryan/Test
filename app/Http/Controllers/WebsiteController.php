<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showAllWebsites()
    {
        $userId = Auth::id();
        $websiteDates = Website::where('user_id', $userId)->get();
        return response()->json([
            'status' => true,
            'data' => $websiteDates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create_website');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:websites,name',
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be less than 255 characters.',
            'name.unique' => 'Name already exists.',
        ]);

        $website = Website::create([
            'name' => $validated['name'],
            'user_id' => Auth::id(),
        ]);
        return $website
            ? redirect()->route('createWebsiteBlade')->with('message', 'Created successfully!')
            : redirect()->back()->with('error', 'Failed to create post.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $website = Website::findOrFail($id);
        return view('dashboard.edit_website', compact('website'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:websites,name,' . $id,
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be less than 255 characters.',
            'name.unique' => 'Name already exists.',

        ]);
        $website = Website::where('id', $id)->update([
            'name' => $validated['name'],
        ]);
        return redirect()->route('indexBlade')->with('message', 'Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->get('website_id');
        $destroy = Website::destroy($id);
        if ($destroy) {
            return response()->json([
                'status' => true,
                'message' => 'Website deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
