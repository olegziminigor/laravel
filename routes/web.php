<?php
Route::get('/', 'SongsController@index');
Route::get('/home', 'SongsController@index');

Route::get('/browse', 'SongsController@browse');
Route::get('/chart', 'SongsController@chartssong');
Route::get('/artist', 'PlaylistController@artists');

Route::get('/lyrics', 'LyricsController@browse');
Route::get('/lyric-detail/{name}/{id}', 'LyricsController@getLyric');

Route::get('/news','NewsController@browse');
Route::get('/full-post/{name}/{id}', 'NewsController@newsdetail');

/************  track detail.html for browse ********/
Route::get('/trackdetail/{name}/{id}', 'SongsController@trackdetail');
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
Route::get('/profile-details/{name}/{id}', 'PlaylistController@artist');

//admin 
Route::get('/admin',function(){
	return view('adminhome');
});

Route::get('/adminhome',function(){
	return view('adminhome');
});

//admin song
Route::get('/adminmusic','HomeController@browse_admin_song');
Route::get('/deletesong/{id}', 'HomeController@deletesong');
Route::get('/deletesongitem/{id}', 'HomeController@deletesongitem');



//admin lyric
Route::get('/adminlyrics', 'HomeController@browse_admin_lyric');
Route::get('/deletelyric/{id}', 'HomeController@deletelyric');

// admin news
Route::get('/adminnews', 'NewsController@browse_admin');
Route::POST('/uploadnews', 'NewsController@uploadnews');
Route::get('/adminnewsdetail','NewsController@adminnewsdetail');
Route::POST('/publishNews','NewsController@publishNews');

// admin users
Route::get('/adminusers','HomeController@getUsers');
Route::get('/deleteuser/{id}','HomeController@deleteuser');


Route::get('/adminads',function(){
	return view('adminads');
});


Route::POST('/publishSong','SongsController@publishSong');
Route::POST('/setfeaturedSong','SongsController@setfeaturedSong');
Route::POST('/publishLyric','LyricsController@publishLyric');

//comments
Route::POST('/leavecomment','CommentController@leavecomment');
Route::get('/admincomments','HomeController@browse_admin_comment');
Route::get('/deletecomment/{id}','HomeController@deletecomment');
Route::POST('/publishComments','CommentController@publishComments');

Route::get('/sendemail', 'SongsController@sendemail');


//download song
Route::get('/downloadsong','PlaylistController@downloadsong');

// search the 
Route::GET('/search','PlaylistController@search');
Route::GET('/search_in','PlaylistController@search_in');


Route::get('musicfeed', 'PlaylistController@musicfeed');
Route::get('lyricsfeed', 'PlaylistController@lyricsfeed');
Route::get('newsfeed', 'PlaylistController@newsfeed');



?>