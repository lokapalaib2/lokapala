<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Category;
use App\Topics;
use App\Tags;
class WebserviceController extends Controller
{
    //
    function categoryListData(Request $request){
    
		$input = $request->all();
		$q = $request->get('q');
		
		if(isset($q) && $q != ""){

			$categroy =  DB::table('category')
				        
				        ->select('name as text')
				        ->addSelect('id')
				        ->where("name", "LIKE", "%{$request->get('q')}%")
				        ->get();
		}else{
			$categroy = DB::select('select id , name as text from category ');
		}
    
    	return response($categroy);

    }
     function topicsListData(Request $request){
     	$input = $request->all();
		$q = $request->get('q');
    	if(isset($q) && $q != ""){

			$categroy =  DB::table('topics')
				        ->select('name as text')
				         ->addSelect('id')
				        ->where("name", "LIKE", "%{$request->get('q')}%")
				        ->get();
		}else{
			$categroy = DB::select('select id , name as text from topics ');
		}
    	return response($categroy);

    }
     function usersListData(Request $request){
     	$input = $request->all();
		$q = $request->get('q');
		$id = $request->get('id');

    	if(isset($q) && $q != ""){

			$categroy =  DB::table('users')
				        ->select('name as text')
				         ->addSelect('id')
				        ->where("name", "LIKE", "%{$request->get('q')}%")
				        ->get();

		}else{
			if(isset($id) && $id != ''){
				$ids=explode(',', $id);
				$categroy =  DB::table('users')
				        ->select('name as text')
				         ->addSelect('id')
				         ->whereIn('id', $ids)
				        ->get();	
			}else{
				$categroy = DB::select('select id , name as text from users ');

			}
		}
    	return response($categroy);

    }
     function tagsListData(Request $request){
     	$input = $request->all();
		$q = $request->get('q');
		$id = $request->get('id');

    	if(isset($q) && $q != ""){

			$categroy =  DB::table('tags')
				        ->select('name as text')
				         ->addSelect('id')
				        ->where("name", "LIKE", "%{$request->get('q')}%")
				        ->get();

		}else{
			if(isset($id) && $id != ''){
				$ids=explode(',', $id);
				$categroy =  DB::table('tags')
				        ->select('name as text')
				         ->addSelect('id')
				         ->whereIn('id', $ids)
				        ->get();	
			}else{
				$categroy = DB::select('select id , name as text from tags ');

			}
		}
    	return response($categroy);

    }
}
