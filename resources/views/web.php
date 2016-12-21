<?php



Route::get('/', 'SongsController@index');
Route::get('/home', 'SongsController@index');

Route::get('/browse', 'SongsController@browse');
Route::get('/chart', 'SongsController@chartssong');


Route::get('/artist', 'PlaylistController@artists');



Route::get('/lyrics', 'LyricsController@browse');
Route::get('/lyricdetail', 'LyricsController@getLyric');


Route::get('/news','NewsController@browse');
Route::get('/newsdetail','NewsController@newsdetail');

/************  track detail.html for browse ********/
Route::get('/trackdetail', function () {
    return view('trackdetail');
});

Route::get('/profile', 'HomeController@showArtiseprofile');

Route::POST('/updateprofile', 'HomeController@update');

Auth::routes();


Route::POST('/setplaylist', 'HomeController@set');

// upload song
Route::POST('/uploadsong', 'SongsController@uploadsong');
Route::POST('/uploadryric', 'LyricsController@uploadlyric');

//upload  image
Route::post('/saveimage', 'HomeController@saveimage');

// artist profile
Route::get('/artistdetail', 'HomeController@artist');


//admin 
Route::get('/admin',function(){
	return view('adminhome');
});

Route::get('/adminhome',function(){
	return view('adminhome');
});
Route::get('/adminmusic','SongsController@browse_admin');
Route::get('/adminlyrics', 'LyricsController@browse_admin');

// admin news
Route::get('/adminnews', 'NewsController@browse_admin');
Route::POST('/uploadnews', 'NewsController@uploadnews');
Route::get('/adminnewsdetail','NewsController@adminnewsdetail');
Route::POST('/publishNews','NewsController@publishNews');



Route::get('/adminads',function(){
	
	return view('adminads');
	
});

Route::get('/adminusers','HomeController@getUsers');
Route::POST('/publishSong','SongsController@publishSong');
Route::POST('/setfeaturedSong','SongsController@setfeaturedSong');

Route::POST('/publishLyric','LyricsController@publishLyric');


//comments

Route::POST('/leavecomment','CommentController@leavecomment');
Route::get('/admincomments','CommentController@browse_admin');
Route::POST('/publishComments','CommentController@publishComments');


//download song
Route::get('/downloadsong','PlaylistController@downloadsong');


// search the 
Route::GET('/search','PlaylistController@search');
Route::GET('/search_in','PlaylistController@search_in');



?>















