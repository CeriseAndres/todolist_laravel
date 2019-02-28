<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\DB;
use App\Todoaction;
use App\Http\Requests\CommentRequest;

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
		$comments = DB::table('comments')->where('user_id', $user_id)->get();
		
		foreach ($comments as $comment)
		{
			$todoaction = DB::table('todoactions')->where('id', $comment->todoaction_id)->get();
			
			$comment->todoaction = $todoaction;
			
		}
		return view('comments')->with('comments', $comments);
	}
	
	//Récupère la liste des comments d'une todoaction
	public function todoactionIndex($todoaction_id)
	{
		$comments = DB::table('comments')->where('todoaction_id', $todoaction_id)->get();
		
		$todoaction_label = DB::select('SELECT label from todoactions where id = ?', [$todoaction_id]);
		$todolist_id = DB::select('SELECT todolist_id from todoactions where id = ?', [$todoaction_id]);
		
		foreach ($comments as $comment)
		{
			$user = DB::table('users')->where('id', $comment->user_id)->get();
			
			$comment->user = $user;
			
		}
		return view('todoaction_comments')->with(['comments' => $comments, 'todoaction_id' => $todoaction_id, 'todoaction_label' => $todoaction_label, 'todolist_id' => $todolist_id]);
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
		DB::insert('insert into comments (text,user_id,todoaction_id,created_at,updated_at) values (?,?,?,?,?)',
				[$request->input('text'), $request->input('user_id'), $request->input('todoaction_id'), now(), now()]);
		
		return back()->with('add-ok', __('Le commentaire n° '.DB::getPdo()->lastInsertId().' a bien été ajouté'));
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
	public function update(CommentRequest $request, $id)
	{
		DB::table('comments')->where('id', $id)->update([
				'text' => $request->input('text'),
				'updated_at' => now()
		]);
// 		$comment = DB::table('comments')->where('id', $id)->get();
		return back()->with(['update-ok'=> __('Le commentaire n° '.$id.' a bien été mis à jour')]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{		
		DB::table('comments')->where('id', $id)
							->delete();		
	
		return back()->with(['del-ok'=> __('Le commentaire n° '.$id.' a bien été supprimé')]);
	}
}
