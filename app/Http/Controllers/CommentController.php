<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Input, Validator, Auth, Redirect, View;
use DB;
class CommentController extends Controller
{
	public function leavecomment(){
		//save the data 
		$msg = 'success';
		$comment = new Comment;
		$comment->news_id  = $_POST['id'];
		$comment->type = $_POST['type'];
		$comment->content  = $_POST['content'];
		$comment->user_id = Auth::user()->id;
		$ret = $comment->save();
		$status = 0;
		if($ret) $status = 1;
		return response()->json(array('msg'=> $msg, 'status'=> $status), 200);	 
	}
	
	
	
	
	public function publishComments(){
		// update
		$msg = "This is a simple message.";
		
		$id = $_POST['id'];
		$act = $_POST['act'];
		$type = $_POST['type'];
	
		$comment = Comment::find($id);
		$comment->status  = $act;
		$comment->type  = $type;

		$ret = $comment->save();
	
		if($ret) {
			$status = 1;
			$msg = "Setting success";
		}
		else{
			$status = 0; 
			$msg = "Setting failed";
		}
		
		return response()->json(array('msg'=> $msg, 'status'=> $status), 200);
		
	}
	
}
