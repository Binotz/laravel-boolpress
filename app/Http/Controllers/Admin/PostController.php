<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_posts = Post::all();
        $data = [
            'posts' => $all_posts,
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $form_data = $request->all();
        $new_post = new Post();

        $request->validate($this->getValidationRules());
        
        $new_post->fill($form_data);
        $new_post->slug = $this->getSlug(Str::slug($form_data['title'], '-'));

        //dd($this->getSlug(Str::slug($form_data['title'], '-')));
        $new_post->save();
        
        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
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
        $post = Post::findOrFail($id);
        $data = [
            'post' => $post,
        ];
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /******************************************* */
    /*Custom Functions */
    /******************************************* */

    protected function getValidationRules(){
        return [
            'title' => 'required | max: 100',
            'content' => 'required',
        ];
    }

    protected function getSlug($slug_original){
        $slug_base = $slug_original;

        $slug_counter = 1;
        
        //controllo se lo slug esiste già
        $slug_exists = Post::where('slug','=',$slug_original)->first();
        
        //se non esiste esco subito con lo slug passato
        if(!$slug_exists){
            return $slug_original;
        }

        //finché lo slug esiste...
        while($slug_exists){
            //... appendo allo slug base il counter..
            $slug_to_insert = $slug_base . '-' . $slug_counter;
            //... e controllo di nuovo se lo slug nuovo esiste
            $slug_exists = Post::where('slug','=',$slug_to_insert)->first();
            //incremento il counter
            $slug_counter++;
        }

        return $slug_to_insert; 
    }


}
