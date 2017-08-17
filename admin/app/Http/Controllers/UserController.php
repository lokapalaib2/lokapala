<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
class UserController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
       
        $input = $request->all();
        $products=User::query()->orderBy('id', 'desc');
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
            
            'email' => 'unique:users',
           
        ]);
        $tambah = new User();
        $tambah->name = $request['name'];
        $tambah->password = bcrypt($request['password']);
        $tambah->email = $request['email'];
        $tambah->save();
        
        return response($tambah);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = User::find($id);
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
                'email' => 'required',
               
        ]);
        $user = User::find($id);          
        if($user->email != $request->input('email')){
             $this->validate($request, [
                'email' => 'unique:users',
               
            ]);
        }
        if(isset($request['password']) && $request['password'] != ''){
           
             $user->update([
            'name' =>  $request->input('name'),
            'email' =>  $request->input('email'),
             'password' => bcrypt( $request->input('password')),
            ]);
        }else{
             $user->update($request->only('name','email'));
        }
        return response($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return User::where('id',$id)->delete();
    }
}
