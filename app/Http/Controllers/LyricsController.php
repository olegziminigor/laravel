<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lyrics;
use App\User, DB, Auth;

class LyricsController extends Controller
{
    //
	
	public function uploadlyric()
	{
		//save the data 
		$lyrics = new Lyrics;
		$lyrics->title  = $_POST['title_upload_song_riryc'];
		$lyrics->content = $_POST['lyrics_content'];
		$lyrics->artise_name  = $_POST['lyrics_artise_name'];
		$lyrics->image  = $_POST['uploadsong_img_riryc'];		
		$lyrics->artise_id = Auth::user()->id;
		$ret = $lyrics->save();
		  //return redirect()->action('SongsController@index')->with('message', 'Thanks for contacting us!');
		if($ret){
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
			
			$lyrics =DB::table('lyrics')->select('lyrics.*', 'users.name')->leftJoin('users', 'users.id', '=', 'lyrics.artise_id')->whereRaw("title like '".$_GET['sort']."%' or title like '".strtoupper($_GET['sort'])."%'")->orderBy('lyrics.updated_at', 'desc')->get();
			
			
			
		}
		else
			$lyrics =DB::table('lyrics')->select('lyrics.*', 'users.name')->leftJoin('users', 'users.id', '=', 'lyrics.artise_id')->whereRaw(" lyrics.status = '1' ")->orderBy('lyrics.updated_at', 'desc')->get();
		
		
		return view('lyrics', array('lyrics'=> $lyrics, 'likesongs'=>app('App\Http\Controllers\SongsController')->getfavoritesongs(), 'playlists' => app('App\Http\Controllers\SongsController')->getplaylistsongs()));
	}
	
	

	public function getLyric($name, $id){
		
		
		$comments =DB::table('comments')->select('comments.*', 'users.name', 'users.image')->leftJoin('users', 'users.id', '=', 'comments.user_id')->whereRaw('comments.type = "1" and comments.news_id = "'. $id .'" ')->get();
	
		$lyric =DB::table('lyrics')->select('lyrics.*', 'users.name')->leftJoin('users', 'users.id', '=', 'lyrics.artise_id')->whereRaw(" lyrics.id = '$id' ")->orderBy('lyrics.updated_at', 'desc')->first();
		
		
		return view('lyricdetail', array('lyric' => $lyric, 'comments' => $comments , 'likesongs'=>app('App\Http\Controllers\SongsController')->getfavoritesongs(),  'playlists' => app('App\Http\Controllers\SongsController')->getplaylistsongs()));
	}
	
	public function publishLyric(){
		// update
		$msg = "This is a simple message.";
		
		$user_id = $_POST['user_id'];
		$id = $_POST['id'];
		$act = $_POST['act'];
	
		$lyric = Lyrics::find($id);
		$lyric->status  = $act;

		$ret = $lyric->save();
	
		if($ret) {
			$status = 1;
			$msg = "Setting success";
		}
		else{
			$status = 0; 
			$msg = "Setting failed";
		}
		
	
		
		if($act == '1'){
			$user = User::find($user_id);
			$email  = $user->email;
			
			$link_url = "http://" . $_SERVER['HTTP_HOST']. $lyric->title.'/lyric-detail/'. $lyric->id;
			$message = "Hello ". $user->name."! <br/> link here </a> Your lyrics  has been approved.  Share the link below on your social media pages to help promote it. We also have a premium promotion service where we can promote your songs,lyrics & Youtube videos to 1000s of Facebook, Twitter and Youtubers. 

				<br/>
				<br/>
				Interested ? Send us an email : promo@africaworships.com
		        Link to share : <a href = 'http://africa.triche-osborne.com/lyric-detail/". $lyric->title. "/". $lyric->id ."'>link here </a>
				<br/>
				Thanks<br/>
				Africa Worships Team
			";
			
			
			$subject = "worship @". $user->name;
			$headers  = "From: worship \r\n";
			$headers .= "Reply-To:\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($email, $subject, $message, $headers);
		}
		
		
	return response()->json(array('msg'=> $msg, 'status'=> $status), 200);
		
	}
	
}
