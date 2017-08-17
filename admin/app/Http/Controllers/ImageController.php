<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Image;
use Intervention\Image\ImageManager;
use Images;
use App\Image_moo;
class ImageController extends Controller
{
    //
     //
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function createcroptinymce(Request $request){
        $is_tinymce = true;
        return view('images.createcrop')->with(compact('is_tinymce'));
    }
    public function createcroppopup(Request $request){

        return view('images.createcrop');
    }
    public function listtinymce(){
      $image = Image::all();
      return view('images.listtinymce')->with(compact('image'));
    }
    public function searchlisttinymce($title){
     $title = $this->decodeURL($title);     
      if($title == '' || $title == '-'){
             $image = Image::all();
      }else{
             $image =  Image::where('name', 'like', '%'.$title.'%')->orderBy('id', 'desc')
                    ->get();
             
      }  
      return view('images.listtinymce')->with(compact('image','title'));
    }
    public function viewlist(){
      $image = Image::all();
      return view('images.viewlist')->with(compact('image'));
    }
     function decodeURL($url){  
        $url = rawurldecode($url);
        return urldecode($url);
    } 
    public function searchviewlist($title){
       $title = $this->decodeURL($title);
       if($title == '' || $title == '-'){
           $image = Image::all();
       }else{
           $image =  Image::where('name', 'like', '%'.$title.'%')->orderBy('id', 'desc')
                  ->get();
            
       } 

      return view('images.viewlist')->with(compact('image','title'));
    }
    public function index(Request $request)
    {
      
        $input = $request->all();
        $products=Image::query()->orderBy('id', 'desc');
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
            'name' => 'required',
            'path' => 'required',
           
            
        ]);
        if ($request->hasFile('path')){
            $is_popup = $request['is_popup'];
            $image = $request['path'];
            $fileName = $image->getClientOriginalName();
            $x1 =  $request['x1'];
            $x2  =  $request['x2'];
            $y1 =  $request['y1'];
            $y2 =  $request['y2'];             
            $newfileName  = time() . '.' . $image->getClientOriginalExtension();
            $request->file('path')->move("pic/original/", $newfileName);
            $this->crop_resize($image,$newfileName,$x1,$x2,$y1,$y2);
            $tambah = new Image();
            $tambah->name = $request['name'];
            $tambah->credit = $request['credit'];
            $tambah->description = $request['description'];
            $tambah->path = $newfileName;
            $tambah->save();
             if($is_popup == 1){
               return view('images.createcrop');
            }else{
               echo "success";
            }
           
        }else{
            echo "file not exist";
        }
    }
    public function modify(Request $request,$id)
    {   
         if ($request->hasFile('path')){
              $update = Image::where('id', $id)->first();
              $filename = $update->path;
              if (isset($request['path']) && $request['path']  != "") {
                if(isset($filename) && $filename != ''){
                  $ex= explode(".", $filename);
                  if(isset($ex) && count($ex)>0){
                     $filesname = $ex[0];
                     $extension = $ex[1];
                     $image_dimension =array('1000x667','960x640','620x413','500x333','400x267','300x200','200x133','150x100');
                     $original_file = public_path() . '/admin/pic/original/' . $filename ; 
                     $cropped_file = public_path() . '/admin/pic/thumb/'.$filesname.'_crop'.".".$extension;   
                     if(file_exists($original_file)){
                        unlink($original_file);
                     }
                     if(file_exists($cropped_file)){
                        unlink($cropped_file);
                     }
                     foreach ($image_dimension as $key => $value) {
                           $resize_file = public_path() . '/admin/pic/resize/'. $filesname.'_crop_'.$value.".".$extension;
                            if(file_exists($resize_file)){
                                  unlink($resize_file);
                              }
                     }
               
                    $x1 =  $request['x1'];
                    $x2  =  $request['x2'];
                    $y1 =  $request['y1'];
                    $y2 =  $request['y2'];
                    $image = Input::file('path');
                    $newfileName  = time() . '.' . $image->getClientOriginalExtension();
                    $request->file('path')->move("pic/original/", $newfileName);
                    $this->crop_resize($image,$newfileName,$x1,$x2,$y1,$y2);
                    $update->path = $newfileName;
                  }
                }
              }
              $update->name = $request['name'];
              $update->credit = $request['credit'];
              $update->description = $request['description'];
              $update->update();
              echo "success";

         }else{
              $update = Image::where('id', $id)->first();
              $update->name = $request['name'];
              $update->credit = $request['credit'];
              $update->description = $request['description'];
              $update->update();
               echo "success";
         }


    }
    private function crop_resize($image,$newfileName,$x1,$x2,$y1,$y2){
      $image_dimension =array('1000x667','960x640','620x413','500x333','400x267','300x200','200x133','150x100');
      $path = public_path().'/admin//pic/original/' . $newfileName;
      list($width, $height) = getimagesize($path);
      $width_resize = 600;
      $rasio = $width/$width_resize;
      $xx1 =  ($x1 * $rasio);
      $yy1 =  ($y1 * $rasio);
      $xx2 =  ($x2 * $rasio);
      $yy2 =  ($y2 * $rasio);
      $filenames = explode(".", $newfileName);
      $CropName  = $filenames[0].'_crop' . '.' . $image->getClientOriginalExtension(); 
      $crop_path = public_path().'/admin/pic/thumb/' . $CropName;      
      $image_moo = new Image_moo;
      if(file_exists($path)){
          $image_moo->load($path)
            ->crop($xx1,$yy1,$xx2,$yy2)
            ->save($crop_path);
      }
  
      if(file_exists($crop_path)){
           foreach($image_dimension as $key => $value){
              $size_file = explode('x',$value);
              $file_final_name_resize = $filenames[0].'_crop_'.$value . '.' . $image->getClientOriginalExtension();
              $des_path_resize =  public_path().'/admin/pic/resize/' . $file_final_name_resize;
              $image_moo
                  ->load($crop_path)
                  ->stretch($size_file[0],$size_file[1])
                  ->save($des_path_resize);
          }
      }   
      
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Image::find($id);
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
       

      $input = $request->all();

        $product=Image::find($id);
        $product->update($input);
        $product=Image::find($id);
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
      $img = Image::where('id', $id)->first();
      $filename = $img->path;
   
        if(isset($filename) && $filename != ''){
          $ex= explode(".", $filename);
          if(isset($ex) && count($ex)>0){
             $filesname = $ex[0];
             $extension = $ex[1];
             $image_dimension =array('1000x667','960x640','620x413','500x333','400x267','300x200','200x133','150x100');
             $original_file = public_path() . '/admin/pic/original/' . $filename ; 
             if(file_exists($original_file)){
              echo "exist";
             }else{
              echo"no exist";
             }
             $cropped_file = public_path() . '/admin/pic/thumb/'.$filesname.'_crop'.".".$extension;   
             if(file_exists($original_file)){
                unlink($original_file);
             }
             if(file_exists($cropped_file)){
                unlink($cropped_file);
             }
             foreach ($image_dimension as $key => $value) {
                   $resize_file = public_path() . '/admin/pic/resize/'. $filesname.'_crop_'.$value.".".$extension;
                    if(file_exists($resize_file)){
                          unlink($resize_file);
                      }
             }
           
          }
        }
        return Image::where('id',$id)->delete();
    }
}
