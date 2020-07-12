<?php
use App\Blog;
use App\User;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        //
        $users = User::orderBy('id', 'DESC')->get();
        return view('users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($user_id)
    {
        //
        $user = User::find($user_id);
        return view('edit_user_form', ['user' => $user]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $user->name = $request->get('name');
        $user->email = $request->get('name');
        $user->type = $request->get('type');

     
        $user->save();
        return redirect()->route('users.index')->with('status', 'تم تعديل المستخدم!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        
        $user = User::find($user_id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'تم حذف المستخدم!');
    }
}
