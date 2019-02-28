<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Todolist;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//$users = DB::table('users')->get(); idem que la ligne suivante
		$users = DB::select('select id,name,email from users limit 100');
		return view('listUsers')->with('users', $users);
	}
	
	//Récupère la liste des users d'une todolist
	public function todolistIndex($todolist_id)
	{
		$users = DB::select('SELECT t1.id, t1.name, t1.email FROM users t1 INNER JOIN user_todolist t2 ON t1.id = t2.user_id WHERE t2.todolist_id = ?',
				$todolist_id);
		return $users;
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('registration');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(RegistrationRequest $request)
	{
		DB::insert('insert into users (name,password,email) values (?,?,?)',
				[$request->input('firstName').' '.$request->input('lastName'), $request->input('password'), $request->input('email')]);
		return view('validatedRegistration')->with('name', $request->input('firstName').' '.$request->input('lastName'));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$user = DB::table('users')->where('id', $id)->get();
		return view('userProfile')->with('user', $user);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return view('userProfile');
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
		$user = DB::table('users')->where('id', $id)->update([
				'name' => $request->input('name'),
				'email' => $request->input('email'),
		    'password' => bcrypt($request->input('password')),
		    'updated_at' => now()
		]);
		return back()->with(['user' => $user, 'update-ok'=> __('L\'utilisateur '.$request->input('name').' a bien été mis à jour')]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{  
	    DB::table('user_todolist')->where('user_id', $id)->delete();
	    DB::table('user_todoaction')->where('user_id', $id)->delete();
		DB::table('users')->where('id', $id)->delete();
		return view('auth/register');
		
	}
}
