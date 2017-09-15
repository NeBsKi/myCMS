<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Page;
use App\Pages_Data;
use App\Page_gallery;
use App\Language;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();

        return view('admin.page.index', compact('pages', $pages));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::all();
        $languages = Language::all();
        
        return view('admin.page.create', compact('pages', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $page = new Page;
        
        $page->parent_id = $request->parent_id;
        $page->slug = $request->slug;
        $page->filter = $request->filter;
        
        if($page->save()){
            $page_id = $page->id;
            
            $data = array(
                array('page_id'=>$page_id, 'title'=>'title', 'data'=>$request->title_ge, 'lang_id'=>$request->lang_id_ge),
                array('page_id'=>$page_id, 'title'=>'body', 'data'=>$request->body_ge, 'lang_id'=>$request->lang_id_ge),
                array('page_id'=>$page_id, 'title'=>'meta_title', 'data'=>$request->meta_title_ge, 'lang_id'=>$request->lang_id_ge),
                array('page_id'=>$page_id, 'title'=>'meta_desc', 'data'=>$request->meta_desc_ge, 'lang_id'=>$request->lang_id_ge),
                array('page_id'=>$page_id, 'title'=>'title', 'data'=>$request->title_en, 'lang_id'=>$request->lang_id_en),
                array('page_id'=>$page_id, 'title'=>'body', 'data'=>$request->body_en, 'lang_id'=>$request->lang_id_en),
                array('page_id'=>$page_id, 'title'=>'meta_title', 'data'=>$request->meta_title_en, 'lang_id'=>$request->lang_id_en),
                array('page_id'=>$page_id, 'title'=>'meta_desc', 'data'=>$request->meta_desc_en, 'lang_id'=>$request->lang_id_en),
                array('page_id'=>$page_id, 'title'=>'title', 'data'=>$request->title_ru, 'lang_id'=>$request->lang_id_ru),
                array('page_id'=>$page_id, 'title'=>'body', 'data'=>$request->body_ru, 'lang_id'=>$request->lang_id_ru),
                array('page_id'=>$page_id, 'title'=>'meta_title', 'data'=>$request->meta_title_ru, 'lang_id'=>$request->lang_id_ru),
                array('page_id'=>$page_id, 'title'=>'meta_desc', 'data'=>$request->meta_desc_ru, 'lang_id'=>$request->lang_id_ru),
            );

            Pages_Data::insert($data);
            
            return redirect('admin/page')->with('msg', 'გვერდი წარმატებით შეიქმნა');
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        $pages = Page::all();
        $languages = Language::all();
        $gallery = DB::table('page_gallery')->where('page_id', $id)->get();
        
        return view('admin.page.edit', compact(['page', 'pages', 'gallery', 'languages']));
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
        $page = Page::find($id);
        
        $page->parent_id = $request->parent_id;
        $page->slug = $request->slug;
        $page->filter = $request->filter;
        
        if($page->save()){
            
            DB::table('pages_data')->where('page_id', $id)->delete();
         
            $data = array(
                array('page_id'=>$id, 'title'=>'title', 'data'=>$request->title_ge, 'lang_id'=>$request->lang_id_ge),
                array('page_id'=>$id, 'title'=>'body', 'data'=>$request->body_ge, 'lang_id'=>$request->lang_id_ge),
                array('page_id'=>$id, 'title'=>'meta_title', 'data'=>$request->meta_title_ge, 'lang_id'=>$request->lang_id_ge),
                array('page_id'=>$id, 'title'=>'meta_desc', 'data'=>$request->meta_desc_ge, 'lang_id'=>$request->lang_id_ge),
                array('page_id'=>$id, 'title'=>'title', 'data'=>$request->title_en, 'lang_id'=>$request->lang_id_en),
                array('page_id'=>$id, 'title'=>'body', 'data'=>$request->body_en, 'lang_id'=>$request->lang_id_en),
                array('page_id'=>$id, 'title'=>'meta_title', 'data'=>$request->meta_title_en, 'lang_id'=>$request->lang_id_en),
                array('page_id'=>$id, 'title'=>'meta_desc', 'data'=>$request->meta_desc_en, 'lang_id'=>$request->lang_id_en),
                array('page_id'=>$id, 'title'=>'title', 'data'=>$request->title_ru, 'lang_id'=>$request->lang_id_ru),
                array('page_id'=>$id, 'title'=>'body', 'data'=>$request->body_ru, 'lang_id'=>$request->lang_id_ru),
                array('page_id'=>$id, 'title'=>'meta_title', 'data'=>$request->meta_title_ru, 'lang_id'=>$request->lang_id_ru),
                array('page_id'=>$id, 'title'=>'meta_desc', 'data'=>$request->meta_desc_ru, 'lang_id'=>$request->lang_id_ru),
            );

            Pages_Data::insert($data);
            
            return redirect('admin/page')->with('msg', 'გვერდი წარმატებით დარედაქტირდა');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $page_id = null)
    {   
        
        if($page_id){
            
            $page = Page::find($page_id);
            
            $gallery_images = DB::table('page_gallery')->where('page_id', $page->id)->pluck('path');
            
            foreach($gallery_images as $image){
                $path = public_path() . $image;
                if(file_exists($path)){
                    unlink($path);
                }  
            } 
            
            if($page->delete()){
                $page_id = $page->id;
                
                DB::table('pages_data')->where('page_id', $page_id)->delete();
                
                DB::table('page_gallery')->where('page_id', $page_id)->delete();                           
            }
        }else{
            $checked = $request->input('chckbx');

            $page = new Page;

            if($page->destroy($checked)){
                DB::table('pages_data')->whereIn('page_id', $checked)->delete();
                DB::table('page_gallery')->whereIn('page_id', $page_id)->delete();
            }
        }
        
        return redirect('admin/page')->with('msg', 'გვერდი წარმატებით წაიშალა');
    }
    
    public static function dataPages($key, $page_id, $lang_id){
        
        $match = ['title' => $key, 'page_id' => $page_id, 'lang_id' => $lang_id];
        
        $results = Pages_Data::where($match)->value('data');
        
        return $results;
        
    }
    
    public function addGallery(Request $request, $page_id){
        
        $file = $request->file('file');
        
        $name = time() . '-' . $file->getClientOriginalName();
       
        $file->move('images/pages/gallery', $name);
        
        $page = Page::find($page_id)->first();
        
        $page->page_gallery()->create(['path' => '/images/pages/gallery/'.$name]);
        
    }
    
    public function filter(Request $request) {

        $title = $request->get('title');
        $is_published = $request->get('is_published');    

        $query = DB::table('pages')->select(DB::raw('id, title, parent_id'));
        
        if($title){
            $query->where('title', 'like', '%' . $title . '%')
                  ->orWhere('is_published', '=', $is_published);           
        }else{
            $query->where('is_published', '=', $is_published);
        }
        
        $pages = $query->get();

        return view('admin.page.index', compact('pages'));
        
    }
}
