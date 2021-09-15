<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_numeric($id)){
            $post = Post::where('id', $id)->get();

            $postTag = Post::find($id)->tags;

            return array($post, $postTag);
        } else if(!is_numeric($id)) {
            
            $tags = Tag::where('tags', $id)->get();
            
            foreach($tags as $tag) {
                $tag->id;
            }
            
            $post = Post::where('tags_id', $tag->id)-> get();

            return $post;
        }
        
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
        if($request->watch) {
           
            return Post::where('id', $id)->update(['watch' => $request->watch]);
        
        } else if($request->likes) {
            
            return Post::where('id', $id)->update(['likes' => $request->likes]); 

        }     
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
}
