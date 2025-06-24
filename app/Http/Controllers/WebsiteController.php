<?php

namespace App\Http\Controllers;

use App\Models\Website;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function create()
    {
        return view('dashboard.create_website');
    }

    public function showAllWebsites()
    {
        $userId = Auth::id();
        $websites = Website::where('user_id', $userId)->get();
        return response()->json([
            'status' => true,
            'data' => $websites
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:websites,name',
        ]);
        $website = Website::create([
            'name' => $validated['name'],
            'user_id' => Auth::id(),
        ]);
        return response()->json(["status" => true, "data" => $website]);
    }

    public function show(string $id)
    {
        $website = Website::find($id);

        if (!$website) {
            return response()->json([
                'status' => false,
                'message' => 'Website not found.'
            ], 404);
        }
        if ($website->user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized.'
            ], 403);
        }
        return response()->json([
            'status' => true,
            'data' => $website
        ]);
    }


    public function showIndex(string $id)
    {
        return view('dashboard.show_website', ['id' => $id]);
    }

    public function editIndex(string $id)
    {

        return view('dashboard.edit_website', ["id" => $id]);

    }

    public function edit(string $id)
    {

        $website = Website::find($id);

        if (!$website) {
            return response()->json([
                'status' => false,
                'message' => 'Website not found.'
            ], 404);
        }
        if ($website->user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized.'
            ], 403);
        }
        return response()->json([
            'status' => true,
            'data' => $website
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:websites,name,' . $id,
        ]);
        Website::where('id', $id)->update([
            'name' => $validated['name'],
        ]);
        return response()->json(["status" => true]);
    }

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
