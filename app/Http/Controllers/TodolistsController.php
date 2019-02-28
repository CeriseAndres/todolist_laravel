<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodolistRequest;
use App\User;
use App\Todolist;
use Illuminate\Support\Facades\DB;

class TodolistsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//$todolists = DB::select('select id,label,updated_at from todolists limit 100');
		$todolists = Todolist::all();
		return view('usertodolist')->with('todolists', $todolists);
	}
	
	//Récupère la liste des todolists d'un user et les noms des users associés
	public function userIndex($user_id)
	{
		$todolists = DB::select('SELECT t1.id, t1.label, t1.updated_at FROM todolists t1 INNER JOIN user_todolist t2 ON t1.id = t2.todolist_id WHERE t2.user_id = ?',
				[$user_id]);
		foreach ($todolists as $todolist)
		{
			$userlist = DB::select('SELECT t1.name FROM users t1 INNER JOIN user_todolist t2 ON t1.id = t2.user_id WHERE t2.todolist_id = ?',
					[$todolist->id]);
			$todolist->users = array();
			
			foreach ($userlist as $user)
			{
				array_push($todolist->users, $user);
			}
		}
		return view('todolists')->with(['todolists' => $todolists]);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('add_todolist')->with(['id' => 1,'users' => User::all()]);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(TodolistRequest $request)
	{
		DB::insert('insert into todolists (label, created_at, updated_at) values (?,?,?)',
				[$request->input('label'), now(), now()]);
		
		DB::insert('insert into user_todolist (user_id, todolist_id) values (?,?)',
				[$request->input('user_id'), DB::getPdo()->lastInsertId()]);
		
		return back()->with('add-ok', __('La liste '.$request->input('label').' a bien été ajoutée'));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$todolist = DB::table('todolists')->where('id', $id)->get();
		return view('xxxxxxxxxxxxxxx')->with('todolist', $todolist);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return view('xxxxxxxxxxxxxxxxxxxxx');
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
		DB::table('todolists')->where('id', $id)->update([
				'label' => $request->input('label')
		]);
		return view('xxxxxxxxxxxxxxxxxx')->with('label', $request->input('label'));
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Todolist $todolist)
	{
		DB::table('user_todolist')->where('todolist_id', $todolist->id)->delete();
		
		$todolist->delete();
		
		return back()->with(['del-ok'=> __('La liste '.$todolist->label.' a bien été supprimée')]);
	}
}
