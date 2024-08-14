<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     //get product get all or search by category id
    //     $products = Product::when($request->category_id, function ($query) use ($request) {
    //         return $query->where('category_id', $request->category_id);
    //     })->paginate(20);
    //     return response()->json([
    //         'message' => 'Success',
    //         'data' => $products
    //     ], 200);
    // }
    public function index(Request $request)
    {
        // get products get all or search by category_id or feature_id pagination

        // validate if request have category_id use this logic
        if ($request->category_id) {
            $products = Product::when($request->category_id, function ($query) use ($request) {
                return $query->where('category_id', $request->category_id);
            });
        }
        // validate if request have feature_id use this logic
        else if ($request->feature_id) {
            $products = Product::when($request->feature_id, function ($query) use ($request) {
                return $query->where('feature_id', $request->feature_id);
            });
        }
        // validate if request have search use this logic
        else if ($request->search) {
            $products = Product::where('name', 'like', '%' . $request->search . '%');
        }
        // if no specific category_id, feature_id or search, get all products
        else {
            $products = Product::query();
        }

        $products = $products->paginate(10);

        // make image from product is array string
        // $products->each(function ($product) {
        //     $product->image = json_decode($product->image, true);
        // });

        return response()->json([
            'message' => 'Success',
            'data' => $products
        ], 200);
    }

    // $categories = Feature::all();
    // return response()->json([
    //     'message' => 'Success',
    //     'data' => $categories
    // ], 200);

    // get detail product by id
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json([
            'message' => 'Success',
            'data' => $product
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // search product by name
    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->name . '%')->get();
        return response()->json([
            'message' => 'Success',
            'data' => $products
        ], 200);
    }
}
