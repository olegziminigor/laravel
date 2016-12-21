<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Comment;
use App\User,Auth;
use DB;
class NewsController extends Controller
{
    //
	function browse_admin(){
		$news = News::all();
		return view('adminnews', compact('news'));
	}
	
	public function uploadnews(){
		//save the data 
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$news = News::find($id);
		}
		else
			$news = new News;
		
		  $news->title  = $_POST['title_upload_news'];
		  $news->content = $_POST['news_upload_content'];
		  if(isset($_POST['uploadnews_img']))
			$news->image  = $_POST['uploadnews_img'];
          $news->save();
		  
		return redirect()->action('NewsController@browse_admin')->with('message', 'Suceess!');
		
	}
	
	public function adminnewsdetail(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			$news = News::find($id);
			return view('adminnewsdetail', compact('news'));
		}
		else
			return view('adminnewsdetail');
	}
	
	public function publishNews(){
		if (Auth::check()){
			$user_id = Auth::user()->id;
		}
		else{
			return redirect()->action('HomeController@index')->with('message', 'Suceess!');
		}
		
		// update
		$msg = "This is a simple message.";
		$id = $_POST['id'];
		$act = $_POST['act'];
		
		$news = News::find($id);
		$news->status  = $act;
		$ret = $news->save();
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
	
	public function browse(){
		
		
		if(isset($_GET['sort'])){
			$sort = $_GET['sort'];
			switch($sort){
				case 'year': 
					$news = News::whereRaw("created_at >= DATE_SUB(NOW(),INTERVAL 1 YEAR) and status = '1'")->orderBy("updated_at", 'DESC')->orderBy("viewed", 'DESC')->get();					
					break;
				case 'month': 
					$news = News::whereRaw("created_at >= DATE_SUB(NOW(),INTERVAL 1 MONTH) and status = '1'")->orderBy("updated_at", 'DESC')->orderBy("viewed", 'DESC')->get();	
					break;
				case 'week': 
					$news = News::whereRaw("created_at >= DATE_SUB(NOW(),INTERVAL 1 WEEK) and status = '1'")->orderBy("updated_at", 'DESC')->orderBy("viewed", 'DESC')->get();
					break;
			}
		}
		else
			$news = News::whereRaw("status = '1'")->orderBy("updated_at", 'DESC')->get();
		
		return view('news', array('news' => $news, 'likesongs'=>app('App\Http\Controllers\SongsController')->getfavoritesongs(),  'playlists' => app('App\Http\Controllers\SongsController')->getplaylistsongs()));
	}
	
	public function newsdetail($name, $id){
		$news = News::find($id);		
		//save
		$viewed = $news->viewed;
		$viewed += 1;
		$news->viewed = $viewed;
		$news->save();		
		//get the comment
		$comments =DB::table('comments')->select('comments.*', 'users.name','users.image')->leftJoin('users', 'users.id', '=', 'comments.user_id')->whereRaw('comments.type = "0" and comments.news_id = "'. $id .'" ')->get();
		
		return view('newsdetail', array('news' => $news, 'comments' => $comments,'likesongs'=>app('App\Http\Controllers\SongsController')->getfavoritesongs(),  'playlists' => app('App\Http\Controllers\SongsController')->getplaylistsongs()));
		
	
	}
	
}
