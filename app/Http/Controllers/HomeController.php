<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Input, Validator, Auth, Redirect, View;
use App\Songs;
use App\Playlist;
use App\Comment;
use App\Lyrics;
use DB;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
	public function update(){
		  $user = User::find(Auth::user()->id);
		  $user->name  = $_POST['account_name'];
		  $user->BIO = $_POST['account_bio'];
		  $user->country  = $_POST['account_country'];
		  $user->website  = $_POST['account_website'];
		  $user->phone  = $_POST['account_phone'];
		  $user->fb  = $_POST['account_fanpage'];
		  $user->tw  = $_POST['account_twitter'];
		  $user->ist  = $_POST['account_inst'];
          $user->save();
		return redirect('profile')->with('message', 'Thanks for contacting us!');
	}
	
	public function saveimage(){
	  $msg = "This is a simple message.";
	  
	  $user = User::find(Auth::user()->id);
	  $user->image  ="server/php/files/" . $_POST['filename'];
	  $ret = $user->save();
	  if($ret) $msg = "Setting Success";
	  else     $msg = "Setting failed";
      return response()->json(array('msg'=> $msg, 'status'=> $ret), 200);
	}
	
	
	public function artists(){
		
		if(isset($_GET['sort'])){
			
		}
		else{
			$artists = User::whereRaw("usertype = '1'")->get();
		}
		return view('artist', compact('artists'));
	}
	
	public function showArtiseprofile(){
		$favorite_songs = app('App\Http\Controllers\SongsController')->getFavoirteByUserID(Auth::user()->id);
		$playlist_songs = app('App\Http\Controllers\SongsController')->getPlaylistByUserID(Auth::user()->id);
		$track_songs = app('App\Http\Controllers\SongsController')->getTrackByUserID(Auth::user()->id);
		$playlists = app('App\Http\Controllers\SongsController')->getplaylistsongs();
		$likesongs = app('App\Http\Controllers\SongsController')->getfavoritesongs();
		
		$user_id = Auth::user()->id;
		$favorite_songsbyuser = Playlist::whereRaw("type = '0'  and user_id = '$user_id'")->get();
			
		return view('profile', compact('favorite_songs', 'playlist_songs', 'track_songs', 'playlists', 'likesongs', 'favorite_songsbyuser'));
	}
	
	public function set(){	
	  $msg = "This is a simple message.";
	  $type    = $_POST['type'];
	  $song_id = $_POST['id'];
	  $act     = $_POST['act'];
	  
	  $ret = 0;
	
	  if($act == 0) $ret = $this::additem($type, $song_id);
	  else          $ret = $this::removeitem($type, $song_id);

	  if($ret) $msg = "Setting Success";
	  else     $msg = "Setting failed";
      return response()->json(array('msg'=> $msg, 'status'=> $ret), 200);
	}
	
	public function additem($type, $song_id){
		
		$user_id = Auth::user()->id;
		$song = Playlist::whereRaw("song_id = '$song_id' and user_id = '$user_id' and type = '$type'")->get();
		
		if(count($song))
		{
			return 1;
		}
		
		$playlist = new Playlist;
		$playlist->song_id = $song_id;
		$playlist->type    = $type;
		$playlist->user_id = Auth::user()->id;
        return $playlist->save();
	}
	
	public function removeitem($type, $song_id){
		return Playlist::whereRaw("type = '$type' and song_id = '$song_id' and user_id = '". Auth::user()->id ."'")->delete();
	}
	
	
	/**********************  admin music   ***********************************************************/
	
	public function browse_admin_song(){
		$songs = Songs::all();
		$count = Songs::where('featured','=','1')->count();
		if($count >= 7) $count = 1;
		else            $count = 0;
		return view('adminmusic', array('songs'=> $songs, 'count'=> $count));
	}
	
	public function deletesongitem($id){
		
		Playlist::where('song_id', '=' , $id)->delete();
		$song = Songs::find($id);
		if(count($song))
			$song->delete();
		Comment::whereRaw("news_id = '$id' and type = '2'")->delete();
		return redirect()->action('HomeController@showArtiseprofile');
	}
	
	public function deletesong($id){
		
		Playlist::where('song_id', '=' , $id)->delete();
		$song = Songs::find($id);
		if(count($song))
			$song->delete();
		Comment::whereRaw("news_id = '$id' and type = '2'")->delete();
		$songs = Songs::all();
		$count = Songs::where('featured','=','1')->count();
		if($count >= 7) $count = 1;
		else            $count = 0;
		return redirect('adminmusic')->with(array('songs'=> $songs, 'count'=> $count));
	}
	
	/*********************************  admin lyrics *************************************************/
	
	public function browse_admin_lyric(){
		$lyrics = Lyrics::all();
		return view('adminlyrics', compact('lyrics'));
	}
	
	public function deletelyric($id){
		$lyric = Lyrics::find($id);
		if(count($lyric))
			$lyric->delete();
		Comment::whereRaw("news_id = '$id' and type = '1'")->delete();
		$Lyrics = Lyrics::all();
		return redirect('adminlyrics')->with(compact('lyrics'));
	}
	
	/**************************** admin comments ****************************************/
	public function browse_admin_comment(){	
		$comments = array();
		$news =DB::table('comments')->select('comments.*', 'news.title')->leftJoin('news', 'news.id', '=', 'comments.news_id')->where('comments.type', 0)->get();

		$songs =DB::table('comments')->select('comments.*', 'song.title')->leftJoin('song', 'song.id', '=', 'comments.news_id')->where('comments.type', 1)->get();
		
		$lyrics =DB::table('comments')->select('comments.*', 'lyrics.title')->leftJoin('lyrics', 'lyrics.id', '=', 'comments.news_id')->where('comments.type', 2)->get();
		
		foreach($news as $commentsitem){
			$comments[] = $commentsitem;
		}
		foreach($songs as $commentsitem){
			$comments[] = $commentsitem;
		}
		foreach($lyrics as $commentsitem){
			$comments[] = $commentsitem;
		}
		return view('admincomments', compact('comments'));
	}
	
	public function deletecomment($id){
		$lyric = Comment::find($id);
		if(count($lyric))
			$lyric->delete();
		
		$comments = array();
		$news  =  DB::table('comments')->select('comments.*', 'news.title')->leftJoin('news', 'news.id', '=', 'comments.news_id')->where('comments.type', 0)->get();

		$songs = DB::table('comments')->select('comments.*', 'song.title')->leftJoin('song', 'song.id', '=', 'comments.news_id')->where('comments.type', 1)->get();
		
		$lyrics = DB::table('comments')->select('comments.*', 'lyrics.title')->leftJoin('lyrics', 'lyrics.id', '=', 'comments.news_id')->where('comments.type', 2)->get();
		
		foreach($news as $commentsitem){
			$comments[] = $commentsitem;
		}
		foreach($songs as $commentsitem){
			$comments[] = $commentsitem;
		}
		foreach($lyrics as $commentsitem){
			$comments[] = $commentsitem;
		}
		return redirect('admincomments')->with(compact('comments'));
	}
	
	/**************************** admin manage users ****************************************/
	public function deleteuser($id){
		$user = User::find($id);
		if(count($lyric)){
			
			$lyric->delete();
			//delete all song
			$user_songs = Songs::where('user_id', '=', $id)->get();
			//songs in playlist
			foreach($user_songs as $user_song){
				$song_id = $user_song->id;
				Playlist::whereRaw("song_id = '$song_id'")->delete();
				Comment::whereRaw("news_id = '$song_id' and type = '2'")->delete();
			}
					
			//delete all lyric
			$user_lyrics = Lyrics::where('user_id', '=', $id)->get();
			foreach($user_lyrics as $user_lyric){
				$lyric_id = $user_lyric->id;
				Comment::whereRaw("news_id = '$lyric_id' and type = '1'")->delete();
			}
			
			
			//delete all playlist and playlist for that users 
			Playlist::whereRaw("user_id = '$id'")->delete();
			Comment::whereRaw("user_id = '$id'")->delete();	
		}	
		
		$users = User::all();
		return redirect('adminusers')->with(compact('users'));
	}
	
	public function getUsers(){
		$users = User::all();
		return view('adminusers', compact('users'));
	}
	
}
