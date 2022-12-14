<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Post;
use App\Category;
use App\Tag;

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
        $data = [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ];
        
        return view('admin.posts.create', $data);
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
        
        if(isset($form_data['cover'])){    
            $image_path = Storage::put('covers', $form_data['cover']);
            $form_data['cover'] = $image_path;
        }

        $new_post->fill($form_data);
        $new_post->slug = $this->getSlug(Str::slug($form_data['title'], '-'));

        //dd($new_post);

        //creo il post, generando anche l'id del post...
        $new_post->save();
        
        //... poi usando l'id vado a creare il record nella tabella ponte
        //Se vengono applicate dei tag, li inserisco...
        if(isset($form_data['tag'])){
            $new_post->tags()->sync($form_data['tag']);
        }else{
            //.. altrimenti non li inserisco
            $new_post->tags()->sync([]);
        }
        
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
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ];

        return view('admin.posts.edit', $data);
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
            //recupero il post da modificare e lo valido
            $new_post = $request->all();
            //dd($new_post);
            $request->validate($this->getValidationRules() );

            //recupero il post da modificare
            $post_to_modify = Post::findOrFail($id);

            //se il titolo tra i post ?? diverso, genero un nuovo slug...
            if($post_to_modify->title !== $new_post['title']){
                $new_post['slug'] = $this->getSlug(Str::Slug($post_to_modify, '-'));
            } else {
                //... se invece ?? uguale, lo mantengo uguale
                $new_post['slug'] = $post_to_modify->slug;
            }

            //se viene passata l'immagine, la modifico nel db
            if(isset($new_post['cover'])){
                $new_post['cover'] = Storage::put('covers', $new_post['cover']);
            }
            //aggiorno il post
            $post_to_modify->update($new_post);
            
            if(isset($new_post['tags'])){
                $post_to_modify->tags()->sync($new_post['tags']);
            } else{
                $post_to_modify->tags()->sync([]);
            }

            //reindirizzo al dettaglio del post
            return redirect()->route('admin.posts.show', ['post' => $post_to_modify->id]);
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
        $post_to_delete = Post::findOrFail($id)->tags()->sync([]);
        $post_to_delete = Post::findOrFail($id);
        if(isset($post_to_delete->cover)){
            Storage::delete($post_to_delete->cover);
        }
        $post_to_delete->delete();
        return redirect()->route('admin.posts.index');

    }

    /******************************************* */
    /*Custom Functions */
    /******************************************* */

    protected function getValidationRules(){
        return [
            'title' => 'required | max: 100',
            'content' => 'required',
            'category_id' => 'nullable',
            'cover' => 'image | nullable'
        ];
    }

    protected function getSlug($slug_original){
        $slug_base = $slug_original;

        $slug_counter = 1;
        
        //controllo se lo slug esiste gi??
        $slug_exists = Post::where('slug','=',$slug_original)->first();
        
        //se non esiste esco subito con lo slug passato
        if(!$slug_exists){
            return $slug_original;
        }

        //finch?? lo slug esiste...
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
