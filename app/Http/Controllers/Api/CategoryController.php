<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->middleware('setDefaultGuard');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            [
            "categories" => Category::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories',
        ]);

        Category::create($validatedData);

        return response()->json([
                'Message' => 'New Category Has Been Added'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        $request['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
        if ($request->slug != $category->slug){
            $rules['slug'] = 'required|unique:categories';
        }

        $validatedData = $request->validate($rules);
        Category::where('id', $category->id)
        ->update($validatedData);

        return response()->json([
            "Message" => "Category Has Been Updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return response()->json([
            'Message' => 'Category Has Been Deleted'
        ]);
    }
}
