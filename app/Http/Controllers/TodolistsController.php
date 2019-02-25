<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodolistsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$todolists = DB::select('select id,label from todolists limit 100');
		return view('listTodolists')->with('todolists', $todolists);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('xxxxxxxxxxxxxxxxxxxxxx');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(TodolistRequest $request)
	{
		DB::insert('insert into todolists (label) values (?)',
				[$request->input('label'), $request->input('email')]);
		return view('xxxxxxxxxxxxxxxx')->with('label', $request->input('label'));
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
		return view('updateRegistration');
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
		DB::table('users')->where('id', $id)->update([
				'name' => $request->input('firstName').' '.$request->input('lastName'),
				'email' => $request->input('email'),
				'password' => $request->input('password')
		]);
		return view('validatedRegistrationUpdate')->with('name', $request->input('firstName').' '.$request->input('lastName'));
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		DB::table('users')->where('id', $id)->delete();
		
	}
}
