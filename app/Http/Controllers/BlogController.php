<?php
use App\Blog;
use App\User;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Blog;

use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $posts = Blog::with('writer')->get();
        return view('post_list', ['posts' => $posts,
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post_create');

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
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]
    );
    $image = $request->file('image');
    $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
    $destinationPath = public_path('/images');
    $image->move($destinationPath, $input['imagename']);
    $article = new Blog();
    $article->title = $request->get('title');
    $article->body = $request->get('body');
    $article->author = Auth::id();
    $article->image = $input['imagename'];
    $article->save();
    return redirect()->route('posts.index')->with('status', 'تم اضافة المقالة بنجاح');
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
    public function edit($post_id)
    {
        //
        $post = Blog::find($post_id);
        return view('edit_form', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id)
    {
        //

        $post = Blog::find($post_id);
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            $post->image = $input['imagename'];
        }
        $post->save();
        return redirect()->route('posts.index')->with('status', 'تم تعديل المقالة ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        //
        $post = Blog::find($post_id);
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'تم حذف المقالة');
    }

    
    public function publisedPost(Request $request,Blog $blog){
        if($blog->actived==1){
            $blog->update(['actived'=>0]);
        }
        else {
            $blog->update(['actived'=>1]);
        }
        return redirect()->back();

    }
}
