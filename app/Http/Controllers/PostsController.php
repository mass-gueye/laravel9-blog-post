<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
//        dd($posts);
        return view('blog.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],
            'min_to_read' => 'min:0|max:60',
        ]);
        Post::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'min_to_read' => $request->min_to_read,
            'body' => $request->body,
            'image_url' => $this->storeImage($request),
            'is_published' => $request->is_published === 'on'
        ]);
        return redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::findOrFail($id);
//        dd($post);
        return view('blog.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::where('id', $id)->first();

        return view('blog.edit', [
            'post' => $post
        ]);
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
        $request->validate([
            'title' => 'required|max:255|unique:posts,title,' .$id,
            'excerpt' => 'required',
            'body' => 'required',
            'image' => ['mimes:jpg,png,jpeg', 'max:5048'],
            'min_to_read' => 'min:0|max:60',
        ]);
        $to_be_processed = $request->except('_token', '_method');
        $to_be_processed['is_published'] === "on" ? $to_be_processed['is_published'] =true: $to_be_processed['is_published']=false;
        Post::where('id', $id)->update($to_be_processed);
        return redirect(route('blog.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect(route('blog.index'))->with('message', 'Post has been deleted');
    }

    private function storeImage($request){
        $new_str = str_replace(' ', '', $request->title);
        $newImageName = uniqid() . '-' . $new_str . '.' . $request->image->extension();
        return $request->image->move(public_path('images'), $newImageName);
    }
}
