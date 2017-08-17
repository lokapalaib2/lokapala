<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Configuration;
class ConfigurationController extends Controller
{
    // public function index(Request $request)
    public function index()
    {
      
    	 $configuration = DB::table('configuration')->first();
         return view('configuration.index', compact('configuration'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      if(isset($request->id) && $request->id != ""){
      		 $input = $request->all();
			     $configuration=Configuration::find($request->id);
	         $configuration->update($input);
	         $configuration->status =true;
	         return view('configuration.index', compact('configuration'));
      }else{
      	 $input = $request->all();
         $create = Configuration::create($input);
          $configuration->status =true;
	      return view('configuration.index', compact('configuration'));
      }
    }

}
