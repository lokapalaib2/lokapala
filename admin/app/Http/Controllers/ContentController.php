<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Content;
use App\Category;
use App\Topics;
use App\Image;
use App\Reltags;
class ContentController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $content = DB::table('content')->orderBy('id', 'desc')->paginate(30);
        return view('content.index', compact('content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {        
        $this->validate($request, [
            'id_category' => 'required',
            'title' => 'required',
            'summary' => 'required',
            'id_penulis' => 'required',
            'id_image_cover' => 'required',
            'body' => 'required',
            
        ]);
        $input = $request->all();
        $create = Content::create($input);
        $insertedId = $create->id;
        $tags = $request->id_tags;
        if(isset($tags) && $tags != ''){
            $tags_array = explode(",", $tags);
        }
     
        if(isset($tags_array) && count($tags_array)>0){
            foreach ($tags_array as $key => $value) {
                 $tags = new Reltags();
                 $tags->id_content = $insertedId;
                 $tags->id_tags = $value;
                 $tags->save();
            }
        }
       
        return redirect()->route('content.index')->with('status', 'Data Berhasil Diubah.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::findOrFail($id);
        $content = $this->getCategory($content);
        $content = $this->getTopics($content);
        $content = $this->getImage($content);
        $content = $this->getTags($content);
        return view('content.edit', compact('content'));
    }
    private function getTags($content){
        if(isset($content->id) && $content->id!= ""){
            $content['tagging'] =  Reltags::where('id_content', $content->id)->get();
        }else{
            $content['tagging'] ="";
        }
        return $content;
    }
    private function getImage($content){
        if(isset($content->id_image_cover) && $content->id_image_cover!= ""){
            $content['image_detail'] = Image::find($content->id_image_cover);
        }else{
            $content['image_detail'] ="";
        }
        return $content;
    }
    private function getCategory($content){
        if(isset($content->id_category) && $content->id_category!= ""){
            $content['category'] = Category::find($content->id_category);
        }else{
            $content['category'] ="";
        }
        return $content;
    }
    private function getTopics($content){
        if(isset($content->id_topics) && $content->id_topics!= ""){
            $content['topics'] = Topics::find($content->id_topics);
        }else{
            $content['topics'] ="";
        }
        return $content;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            
            'title' => 'required',
            'summary' => 'required',
           
            'body' => 'required',
            
        ]);
        $input = $request->all();

        $product=Content::find($id);
        $product->update($input);
        DB::table('rel_tags')->where('id_content', $id)->delete();
        $tags = $request->id_tags;
        if(isset($tags) && $tags != ''){
            $tags_array = explode(",", $tags);
        }    
        if(isset($tags_array) && count($tags_array)>0){
            foreach ($tags_array as $key => $value) {
                 $tags = new Reltags();
                 $tags->id_content = $id;
                 $tags->id_tags = $value;
                 $tags->save();
            }
        }
        
        return redirect()->route('content.index')->with('status', 'Data Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cruds = Content::findOrFail($id);
        $cruds->delete();
        DB::table('rel_tags')->where('id_content', $id)->delete();
        return redirect()->route('content.index')->with('status', 'Data Berhasil Dihapus.');
    }
}
