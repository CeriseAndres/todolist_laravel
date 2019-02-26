<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$comments = DB::table('comments')->paginate(10);
		return view('xxxxxxxxxxxxxx')->with('comments', $comments);
	}
	
	//Récupère la liste des comments d'un user
	public function userIndex($user_id)
	{
		$comments = DB::select('SELECT id, text FROM comments WHERE user_id = ?',
				$user_id);
		return view('xxxxxxxxxxxxxxxxx')->with('comments', $comments);
	}
	
	//Récupère la liste des comments d'une todoaction
	public function todoactionIndex($todoaction_id)
	{
		$comments = DB::select('SELECT id, text FROM comments WHERE todoaction_id = ?',
				$todoaction_id);
		return view('xxxxxxxxxxxxxxxxx')->with('comments', $comments);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('xxxxxxxxxxxxxxxxxxxx');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CommentRequest $request)
	{
		DB::insert('insert into comments (text,user_id,todoaction_id) values (?,?,?)',
				[$request->input('text'), $request->input('user_id'), $request->input('todoaction_id')]);
		//return view('xxxxxxxxxxxxxxxxxxxx')->with('xxxxx', );
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$comment = DB::table('comments')->where('id', $id)->get();
		return view('xxxxxxxxxx')->with('comment', $comment);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return view('xxxxxxxxxxxxxxx');
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
		DB::table('comments')->where('id', $id)->update([
				'text' => $request->input('text'),
				'updated_at' => now()
		]);
		$comment = DB::table('comments')->where('id', $id)->get();
		return view('xxxxxxxxxxx')->with('comment', $comment);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		DB::table('comments')->where('id', $id)->delete();
		
	}
}
