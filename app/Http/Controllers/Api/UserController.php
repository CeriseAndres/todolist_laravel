<?php
namespace App\Http\Controllers\Api;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('api/create');
    }
    
    public function store(Request $request)
    {
        User::create($request->all());
        return "Utilisateur créé !";
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('api/edit', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return "Utilisateur modifié !";
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    	DB::table('comments')->where('user_id', $id)->delete();
    	DB::table('user_todolist')->where('user_id', $id)->delete();
    	DB::table('user_todoaction')->where('user_id', $id)->delete();
    	DB::table('users')->where('id', $id)->delete();
    	return route('logout');
    }
    
    public function destroyForm(User $user)
    {
        return view('api/destroy', compact('user'));
    }
}