<?php
namespace App\Http\Controllers;
use App\Blog;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        
        $number_of_posts = Blog::count();
        $number_of_authors = User::count();
        $new_posts = Blog::orderBy('id', 'DESC')->take(5)->get();
        $new_authors = User::orderBy('id', 'DESC')->take(5)->get();

        $data = [
            'post_count' => $number_of_posts,
            'author_count' => $number_of_authors,
            'new_posts' => $new_posts,
            'new_authors' => $new_authors,
        ];
        
        return view('home', $data);
    }
    public function getRegisteredUsers()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('users', ['users' => $users]);
    }
    public function edituser($user_id){
        $user = User::find($user_id);
        return view('edit_user_form', ['user' => $user]);   
     }

     public function updateuser(Request $request, $user_id)
     {
         $user = User::find($user_id);
         $user->name = $request->get('name');
         $user->email = $request->get('name');
         $user->type = $request->get('type');

      
         $user->save();
         return redirect()->route('registered_users')->with('status', 'تم تعديل المستخدم!');
     }

     public function deleteuser($user_id){
        $user = User::find($user_id);
        $user->delete();
        return redirect()->route('registered_users')->with('status', 'تم حذف المستخدم!');

     }

    public function PostList()
    {       
        $user= User::get();
        $posts = Blog::with('writer')->get();
        return view('post_list', ['posts' => $posts,'user'=>$user
       ]);
    }
    
    public function createPost()
    {
        return view('post_create');
    }
 
    public function storePost(Request $request)
    {
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
        return redirect()->route('all_posts')->with('status', 'تم اضافة المقالة بنجاح');
    }

    public function editPost($post_id)
    {
        $post = Blog::find($post_id);
        return view('edit_form', ['post' => $post]);
    } 



    public function updatePost(Request $request, $post_id)
    {
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
        return redirect()->route('all_posts')->with('status', 'تم تعديل المقالة ');
    }
    public function deletePost($post_id)
    {
        $post = Blog::find($post_id);
        $post->delete();
        return redirect()->route('all_posts')->with('status', 'تم حذف المقالة');
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