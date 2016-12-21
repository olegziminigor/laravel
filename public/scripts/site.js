(function ($) {
	'use strict';

    // btn more
    $(document).on('click.site', '.btn-more', function(e) {
      var $dp = $(this).next('.dropdown-menu');
      if( $dp.html() == "" ){
		  
		var data = $(this).attr("data-downloadsrc");
		var track_id = $(this).data("id");
        
		if($(this).hasClass('profile'))
			$dp.append('<a class="dropdown-item dropdown-playlist" href="#"><i class="fa fa-music fa-fw text-left"></i> Add to Playlist</a><a class="dropdown-item dropdown-downloadsong"  href="/downloadsong?file='+ data +'&id='+ track_id +'" ><i class="fa fa-share-alt fa-fw text-left"></i> DownLoad Song</a><div class="dropdown-divider"></div>');
		else
			$dp.append('<a class="dropdown-item dropdown-playlist profile" href="#"><i class="fa fa-music fa-fw text-left"></i> Add to Playlist</a><a class="dropdown-item dropdown-downloadsong"  href="/downloadsong?file='+ data +'&id='+ track_id +'" ><i class="fa fa-share-alt fa-fw text-left"></i> DownLoad Song</a><div class="dropdown-divider"></div>');
		
      }

	  
	//   Download</a>
		
      if( (e.pageY + $dp.height() + 60) > $('body').height() ){
        $dp.parent().addClass('dropup');
      }

      if( e.pageX < $dp.width() ){
        $dp.removeClass('pull-right');
      }

    });
    
	/*************************************************************************************************/
	/*  set favorite action 
	/*************************************************************************************************/
    $(document).on('click.site', '#search-result a', function(e) {
      $(this).closest('.modal').modal('hide');
    });
	
	$(document).on("click", '.dropdown-playlist', function(){
		
		var track_id = $(this).closest(".item").data("id");
		var act  = 0;
		if($(this).hasClass("added")) act = 1;
		else						  act = 0;
		var $obj = $(this);
		setPlaylist(1, track_id , act, $obj);
	});
	
	// set favorite song

	$(document).on("click", ".btn-favorite", function(){
	
		var track_id = $(this).closest(".item").data("id");
		var act  = 0;
		if($(this).hasClass('is-like')) act = 1;
		else						    act = 0;
		var $obj = $(this);
		setPlaylist(0, track_id , act, $obj);
	});
	
	function setPlaylist(type, song_id, act, $obj){
		if(login == '0')
		{
			location = '/login';
		}
		else
		$.ajax({
		   type:'POST',
		   url:'/setplaylist',
		   data:{ _token : $("#hidden_token").val(), type: type,  id: song_id, act: act},
		   success:function(data){
			
				if(data.status == '1'){
					
					switch(type){
						case 0:
							$obj.hasClass("is-like") ? $obj.removeClass("is-like") : $obj.addClass("is-like");
							
							if($obj.hasClass('profile')){
								location.reload();
									
									//add to the doc
									/*									
									$obj.closest('.profile-itemsong').clone().appendTo("#like .row.m-b");
									
									var song_id = '';
									var source = '';
									var track_url = '';
									var song_image = '';
									var fav_songcount = '';
									var title = '';
									
									var downloadsrc ='';
									
									
									
						var html = '<div class="col-xs-4 col-sm-4 col-md-3 profile-itemsong">';
						html +=    '<div class="item r" data-id="'+ song_id +'" data-src="server/php/files/'+ source +'">';
						html += 	'<div class="item-media ">';
						html += '<a href="' + track_url + '" class="item-media-content" style="background-image: url(\'server/php/files/' + song_image +'\');"></a>';
								
						
						
						html +=	'<div class="item-overlay center">';
						html += '<button  class="btn-playpause">Play</button>';
						html += '</div></div><div class="item-info"><div class="item-overlay bottom text-right">';

						html +=	'<a href="#" class="btn-favorite profile is-like"><i class="fa fa-heart-o"></i></a>';
						html +=  '<a href="#" class="btn-more" data-toggle="dropdown"  data-downloadsrc = "server/php/files/'+ source +'" data-id="'+song_id +'"><i class="fa fa-ellipsis-h"></i></a>';
									
						html += '<div class="dropdown-menu pull-right black lt"></div></div>';
						html += '<div class="item-title text-ellipsis"><a href="'+ track_url +'">' + title + '</a></div>';
						
						html += '<div class="item-author text-sm text-ellipsis hide">';								
						html += '<a href="#" class="text-muted"></a></div>';
						html += '<div class="item-meta text-sm text-muted"><span class="item-meta-stats text-xs "><i class="fa fa-heart m-l-sm text-muted"></i> '+ fav_songcount +'</span></div></div></div></div>';
			
						*/	
								
							}
							
							
							break;
						case 1:
						/*
							if($obj.hasClass("added")){
								$obj.removeClass("added");
								$obj.html('<i class="fa fa-music fa-fw text-left"></i> Remove to Playlist');
							}
							else{
								$obj.addClass("added");
								$obj.html('<i class="fa fa-music fa-fw text-left"></i> Add to Playlist');
							}
						*/
							if($obj.hasClass('profile')){
								location.reload();
							}
							break;
					}
					
				}
				
		   }
		});
	 }	

	
	$(document).on("click", ".track-remove", function(){
		setPlaylist(1, $(this).data('id'), 1, $(this));
	});
	
	
	$(document).on('click', ".delete-item-btn", function(){
		$(".delete-songitem").attr('href', $(this).attr('href'));
	});
	
	
	$(".delete-songitem").click(function(event){
		
		location = $(this).attr('href');
		
	});
	
	 
	 
})(jQuery);
