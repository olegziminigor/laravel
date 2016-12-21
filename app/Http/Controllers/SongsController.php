<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Songs;
use App\User;
use App\Playlist;
use App\Comment;
use App\Lyrics;
use App\News;
use Input, Validator, Auth, Redirect, View, DB;
use Mail;
class SongsController extends Controller
{
    //
	//public protected 
	
	public function index(){
		//featured songs
		
		
		
		if (Auth::check()){
			$user_id = Auth::user()->id;
			$favorite_songsbyuser = Playlist::whereRaw("type = '0'  and user_id = '$user_id'")->get();
		}	
		
		$featuredsongs = Songs::whereRaw("featured = '1' and status = '1' ")->get();
		
		foreach($featuredsongs as $featuredsong){
			$featuredsong['artist'] = User::find($featuredsong['artise_id']);
		}
		$count = Songs::where('featured','=','1')->count();
		
		//trading
		$treadsongs = Songs::whereRaw('status = "1"')->orderBy("downloaded")->orderBy("loved")->limit(9)->get();
		foreach($treadsongs as $treadsong){
			$treadsong['artist'] = User::find($treadsong['artise_id']);
		}
		
		
		//news
		$newsongs = Songs::whereRaw("status = '1'")->orderBy("created_at", 'DESC')->limit(8)->get();
		foreach($newsongs as $newsong){
			$newsong['artist'] = User::find($newsong['artise_id']);
		}
		
		
		//recommend for you.
		
		//news
		$newlyrics = Lyrics::whereRaw("status = '1'")->orderBy("created_at", 'DESC')->limit(5)->get();
		$newnews = News::whereRaw("status = '1'")->orderBy("created_at", 'DESC')->limit(5)->get();
		
		
		$playlistsongs = $this->getplaylistsongs();
		
		if(Auth::check())
			return view('home', array('featuredsongs'=>$featuredsongs, "count" => $count, 'newsongs'=> $newsongs, 'treadsongs'=> $treadsongs, 'favorite_songsbyuser' => $favorite_songsbyuser, 'likesongs' => $this->getfavoritesongs(), 'playlists' => $playlistsongs, 'newlyrics'=> $newlyrics, 'newnews'=>$newnews));
		else
			return view('home', array('featuredsongs'=>$featuredsongs, "count" => $count, 'newsongs'=> $newsongs, 'treadsongs'=> $treadsongs, 'likesongs'=> $this->getfavoritesongs(), 'playlists' => $playlistsongs, 'newlyrics'=> $newlyrics, 'newnews'=>$newnews));
    }
	
	
	
	public function uploadsong()
	{
		//save the data 
		$songs = new Songs;
		$songs->title  = $_POST['title_upload_song'];
		$songs->source = $_POST['uploadsong_src'];
		$songs->image  = $_POST['uploadsong_img'];
		$songs->artise_id = Auth::user()->id;
        $ret = $songs->save();
		  
		if($ret){
			$status = 1;
			$msg = "Setting success";
		}
		else{
			$status = 0; 
			$msg = "Setting failed";
		}
		return response()->json(array('msg'=> $msg, 'status'=> $status), 200);  
		//return redirect()->action('HomeController@index')->with('message', 'Thanks for contacting us!');
	}
	
	
	
	//browse the data criteria sort
	public function getFavoirteByUserID($user_id){
		$fav_sonlists =	Playlist::whereRaw("user_id = '".$user_id."' and type = '0'")->get();
		$favorite_songs = array();
		foreach($fav_sonlists as $fav_song){
			$song_id = $fav_song->song_id;
			$song = Songs::find($song_id);
			$song['fav_count'] = Playlist::whereRaw("type = '0' and song_id = '$song_id'")->count();
			$favorite_songs[] = $song;
		}
		return $favorite_songs;
	}
	
	public function getPlaylistByUserID($user_id){
		$playlists    = Playlist::whereRaw("user_id = '".$user_id."' and type = '1'")->get();
		$playlist_songs = array();
		foreach($playlists as $playlist){
			$song_id = $playlist->song_id;
			$song = Songs::find($song_id);
			$song['fav_count'] = Playlist::whereRaw("type = '0' and song_id = '$song_id'")->count();
			$playlist_songs[] = $song;
		}
		return $playlist_songs;
	}
	
	
	public function getTrackByUserID($user_id){
		$track_songs  = Songs::where('artise_id','=',$user_id)->get();
		return $track_songs;
	}
	
	
	
	
	public function browse(){
		
		if (Auth::check()){
			$user_id = Auth::user()->id;
			$favorite_songsbyuser = Playlist::whereRaw("type = '0'  and user_id = '$user_id'")->get();
		}
		
		
		if(isset($_GET['sort'])){
			//$songs = Songs::whereRaw("(title like '".$_GET['sort']."%' or title like '".strtoupper($_GET['sort'])."%') and (status = '1')")->get();
			$songs = DB::table('song')->select('song.*', 'users.name')->leftJoin('users', 'users.id', '=', 'song.artise_id')->whereRaw("(song.title like '".$_GET['sort']."%' or song.title like '".strtoupper($_GET['sort'])."%') and (song.status = '1')")->get();
		}
		else{
			$songs =DB::table('song')->select('song.*', 'users.name')->leftJoin('users', 'users.id', '=', 'song.artise_id')->whereRaw("song.status = '1'")->orderBy('song.updated_at', 'desc')->get();
			
		}
			
		
		if (Auth::check()){
			$user_id = Auth::user()->id;
		}
		
		if(Auth::check())
			return view('browse', array('songs' => $songs, 'favorite_songsbyuser' => $favorite_songsbyuser, 'likesongs'=> $this->getfavoritesongs() , 'playlists' => $this->getplaylistsongs()));
		else
			return view('browse', array('songs' => $songs, 'likesongs'=> $this->getfavoritesongs(), 'playlists' => $this->getplaylistsongs()));
			
	}
	
	public function publishSong(){
		// update
		$msg = "This is a simple message.";
		
		$user_id = $_POST['user_id'];
		$id = $_POST['id'];
		$act = $_POST['act'];
		
		$song = Songs::find($id);
		$song->status  = $act;
		$ret = $song->save();
		if($ret) {
			$status = 1;
			$msg = "Setting success";
		}
		else{
			$status = 0; 
			$msg = "Setting failed";
		}
		
		// send email
		if($act == '1'){
			$user = User::find($user_id);
		//	$email  = $user->email;
			$email  = 'cr3884489@gmail.com';
			
			$link_url = "http://" . $_SERVER['HTTP_HOST']. $song->title.'/trackdetail/'. $song->id;
			$message = "Hello ". $user->name."! <br/> Your  song has been approved.   Share the link below on your social media pages to help promote it. We also have a premium promotion service where we can promote your songs,lyrics & Youtube videos to 1000s of Facebook, Twitter and Youtubers.
				<br/>
				<br/>
				Interested ? Send us an email : promo@africaworships.com
		        Link to share : <a href = 'http://africa.triche-osborne.com/trackdetail/". $song->title. "/". $song->id ."'>link here </a>
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
	

	public function setfeaturedSong(){		
		if (Auth::check()){
			if(Auth::user()->usertype == '2'){
				$msg = 'This is simple message';
				// check total count
				$count = Songs::where('featured','=','1')->count();
				$id  = $_POST['id']; 
				$act = $_POST['act'];
				
				if(($count >= 7) && $act == 1){
					return response()->json(array('msg'=> $msg, 'status'=> 0, 'total'=> 0), 200);
				}
				$song = Songs::find($id);
				$song->featured  = $act;
				$ret = $song->save();
				$count = Songs::where('featured','=','1')->count();
				

				if($ret) {
					$status = 1;
					$msg = "Setting success";
				}
				else{
					$status = 0; 
					$msg = "Setting failed";
				}
				if($count >= 7) $count = 1;
				else			$count = 0;

				return response()->json(array('msg'=> $msg, 'status'=> $status, 'total'=> $count), 200);
			}	
		}
		$msg = "Cannot set!";
		return response()->json(array('msg'=> $msg, 'status'=> 0), 200);

	}
	
	
	public function chartssong(){
		
		if (Auth::check()){
			$user_id = Auth::user()->id;
			$favorite_songsbyuser = Playlist::whereRaw("type = '0'  and user_id = '$user_id'")->get();
		}
		
		if(isset($_GET['sort'])){
			$sort = $_GET['sort'];
			switch($sort){
				case 'year': 
					$chartsongs =DB::table('song')->select('song.*', 'users.name')->leftJoin('users', 'users.id', '=', 'song.artise_id')->whereRaw("song.created_at >= DATE_SUB(NOW(),INTERVAL 1 YEAR) and song.status = '1'")->orderBy("song.downloaded", 'DESC')->orderBy("song.loved", 'DESC')->get();
					break;
				case 'month': 
					$chartsongs =DB::table('song')->select('song.*', 'users.name')->leftJoin('users', 'users.id', '=', 'song.artise_id')->whereRaw("song.created_at >= DATE_SUB(NOW(),INTERVAL 1 MONTH) and song.status = '1'")->orderBy("song.downloaded", 'DESC')->orderBy("song.loved", 'DESC')->get();
					break;
				case 'week': 
					$chartsongs =DB::table('song')->select('song.*', 'users.name')->leftJoin('users', 'users.id', '=', 'song.artise_id')->whereRaw("song.created_at >= DATE_SUB(NOW(),INTERVAL 1 WEEK) and song.status = '1'")->orderBy("song.downloaded", 'DESC')->orderBy("song.loved", 'DESC')->get();
					break;
			}
		}
		else
			$chartsongs =DB::table('song')->select('song.*', 'users.name')->leftJoin('users', 'users.id', '=', 'song.artise_id')->whereRaw('song.status = "1"')->orderBy("downloaded", 'DESC')->orderBy("loved", 'DESC')->get();
		
		if(Auth::check())
			return view('chart', array('chartsongs' => $chartsongs, 'favorite_songsbyuser' => $favorite_songsbyuser, 'likesongs'=> $this->getfavoritesongs(), 'playlists' => $this->getplaylistsongs()));
		else
			return view('chart', array('chartsongs' => $chartsongs , 'likesongs'=> $this->getfavoritesongs(), 'playlists' => $this->getplaylistsongs()));
	}
	
	public function trackdetail($name, $id) {
		if (Auth::check()){
			$user_id = Auth::user()->id;
			$favorite_songsbyuser = Playlist::whereRaw("type = '0'  and user_id = '$user_id'")->get();
		}
		$song = Songs::find($id);
			
		// artise_id
		$track_user = User::find($song->artise_id);
		$user_songs = Songs::whereRaw('artise_id =' . $song->artise_id . " and status = '1'")->get();
		
		$comments =DB::table('comments')->select('comments.*', 'users.name', 'users.image')->leftJoin('users', 'users.id', '=', 'comments.user_id')->whereRaw('comments.type = "2" and comments.news_id = "'. $id .'" ')->get();

		if(Auth::check())
			return view('trackdetail', array('song'=> $song, 'user_songs' => $user_songs, 'track_user' => $track_user, 'comments' => $comments, 'favorite_songsbyuser' => $favorite_songsbyuser, 'likesongs'=> $this->getfavoritesongs(), 'playlists' => $this->getplaylistsongs()));
		else
			return view('trackdetail', array('song'=> $song, 'user_songs' => $user_songs, 'track_user' => $track_user, 'comments' => $comments, 'likesongs'=> $this->getfavoritesongs(), 'playlists' => $this->getplaylistsongs()));
	}
	
	public function getfavoritesongs(){
		//news
		
		$getfavoritesongs = DB::select(DB::raw("select `song`.* from `song` left join (SELECT * from playlist where type = '0' group by song_id) as playlist on `song`.`id` = `playlist`.`song_id` where song.status = '1' limit 5"));
		
		
		//SELECT  * from playlist where type = 0 GROUP by id
		foreach($getfavoritesongs as $getfavoritesong){
			$getfavoritesong->artist = User::find($getfavoritesong->artise_id);
		}
		return $getfavoritesongs;
	}
	
	
	public function getplaylistsongs(){
		// if do not log in and there is no player list then random songs		
		$flag = true;
		
		if(Auth::check()){
			$user_id = Auth::user()->id;
			$favsongs = DB::table('song')->select('song.*')->leftJoin('playlist', 'playlist.song_id', '=', 'song.id')->whereRaw("playlist.user_id = '$user_id' and playlist.type = '1' and song.status = '1'")->get();
			if(count($favsongs))
				$flag = false;
		}
		
		
		
		if($flag){
			$favsongs =  DB::table('song')->whereRaw("status = '1'")->orderByRaw('RAND()')->limit(5)->get();
		}
		
		foreach($favsongs as $favsong){
			$artise = User::find($favsong->artise_id);
			
			$song_id = $favsong->id;
			
			$song_item['id'] = $song_id;
			$song_item['title'] = $favsong->title;
			
			$display_txt = $favsong->title;
			$display_txt = str_replace(" ","-",$display_txt);
							
			$song_item['link']  = "/trackdetail/$display_txt/".$song_id;
			$song_item['thumb'] = array("src" => asset("server/php/files/" . $favsong->image));
			$song_item['src']   = asset('server/php/files/' . $favsong->source);
			
			
			$display_txt = $artise->name;
			$display_txt = str_replace(" ","-",$display_txt);
			
			$song_item['meta']  = array('author' => $artise->name, 'authorlink' => "/artistdetail/$display_txt");
			
			
			$playlists[] = $song_item;
		}
		
		
		
		return $playlists;
		
	}
	
	public function sendemail(){
		
		echo 'dd';
		$data = array('name' => 'Jordan');

			Mail::send('welcome', $data, function ($message) {
				$message->from('us@example.com', 'Laravel');

				$message->to('whitebear619@hotmail.com')->cc('cr3884489@gmail.com');
			});
			
		
	}

}
