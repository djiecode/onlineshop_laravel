<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Feature;

class FeatureController extends Controller
{
        // index
        public function index(Request $request)
        {
            // get user with paginantin
            $features = DB::table('features')
                ->when($request->input('name'), function ($query, $name) {
                    return $query->where('name', 'like', '%' . $name . '%');
                })
                ->paginate(5);
            return view('pages.feature.index', compact('features'));
        }

        // create
        public function create()
        {
            return view('pages.category.create');
        }


    //store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        $feature = \App\Models\Feature::create($validated);

        return redirect()->route('feature.index')->with('success', 'Feature created successfully');
    }

    // edit
    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        return view('pages.feature.edit', compact('feature'));
    }

     // update
     public function update(Request $request, $id)
     {
         $validated = $request->validate([
             'name' => 'required|max:100',
         ]);

         $feature = \App\Models\Feature::findOrFail($id);
         $feature->update($validated);

         return redirect()->route('feature.index')->with('success', 'Feature updated successfully');
     }

     // destroy
     public function destroy($id)
     {
         $features = Feature::findOrFail($id);
         $features->delete();
         return redirect()->route('feature.index')->with('success', 'Feature deleted successfully');
     }
}
