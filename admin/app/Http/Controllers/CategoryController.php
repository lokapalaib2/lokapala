<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
class CategoryController extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public function index(Request $request)
    {
      
        $input = $request->all();
        $products=Category::query()->orderBy('id', 'desc');
        if($request->get('search')){
            $products = $products->where("name", "LIKE", "%{$request->get('search')}%")->orderBy('id', 'desc');
        }
      $products = $products->paginate(5);
        
        return response($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
                'slug' => 'required|unique:category',
               
        ]);
      $input = $request->all();
        $create = Category::create($input);
        return response($create);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Category::find($id);
        return response($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
                'slug' => 'required',
               
        ]);
        $input = $request->all();
        $product=Category::find($id);
        if($product->slug != $request->input('slug')){
             $this->validate($request, [
                'slug' => 'unique:category',
               
            ]);
        }
       
       
        $product->update($input);
       
        return response($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return Category::where('id',$id)->delete();
    }
}
