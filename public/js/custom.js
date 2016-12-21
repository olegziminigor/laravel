$(document).ready(function(){


  $(".submenu > a").click(function(e) {
    e.preventDefault();
    var $li = $(this).parent("li");
    var $ul = $(this).next("ul");

    if($li.hasClass("open")) {
      $ul.slideUp(350);
      $li.removeClass("open");
    } else {
      $(".nav > li > ul").slideUp(350);
      $(".nav > li").removeClass("open");
      $ul.slideDown(350);
      $li.addClass("open");
    }
  });
  
/********************************admin ryric putblish******************************/
$(document).on("click",".admin-publish-lyric", function(){
	var id = $(this).data('id'), user_id = $(this).data('user-id');
	publishLyrcic(id, user_id, $(this), 1);
});
$(document).on("click",".admin-unpublish-lyric", function(){
	var id = $(this).data('id'), user_id = $(this).data('user-id');
	publishLyrcic(id, user_id, $(this), 0);
});	

function publishLyrcic(id, user_id, $obj, act){
	$.ajax({
		   type:'POST',
		   url:'/publishLyric',
		   data:{ _token : $("#hidden_token").val(), id : id, user_id: user_id,act: act},
		   success:function(data){
				if(data.status == 1){
					if(act == 1)  //publish
					{
						$obj.removeClass("admin-publish-lyric");
						$obj.addClass("admin-unpublish-lyric");
						$obj.html("Unpublish");
						$obj.closest(".odd.gradeX").find(".status").html("Published");
					}
					else{  //unpublish
						$obj.addClass("admin-publish-lyric");
						$obj.removeClass("admin-unpublish-lyric");
						$obj.html("Publish");
						$obj.closest(".odd.gradeX").find(".status").html("Unpublished");
					}
				}
				else{
					alert(data.msg);
				}
				
		   }
	});
	
}

/********************************admin song putblish******************************/
$(document).on("click",".admin-publish-song", function(){
	var id = $(this).data('id'), user_id = $(this).data('user-id');
	publishSong(id, user_id, $(this), 1);
});
$(document).on("click",".admin-unpublish-song", function(){
	var id = $(this).data('id'), user_id = $(this).data('user-id');
	publishSong(id, user_id, $(this), 0);
});	

function publishSong(id, user_id, $obj, act){
	$.ajax({
		   type:'POST',
		   url:'/publishSong',
		   data:{ _token : $("#hidden_token").val(), id : id, user_id: user_id,act: act},
		   success:function(data){
				if(data.status == 1){
					if(act == 1)  //publish
					{
						$obj.removeClass("admin-publish-song");
						$obj.addClass("admin-unpublish-song");
						$obj.html("Unpublish");
						$obj.closest(".odd.gradeX").find(".status").html("Published");
						
							
					}
					else{  //unpublish
						$obj.addClass("admin-publish-song");
						$obj.removeClass("admin-unpublish-song");
						$obj.html("Publish");
						$obj.closest(".odd.gradeX").find(".status").html("Unpublished");
					}
				}
				else{
					alert(data.msg);
				}
				
		   }
	});
	
}

$(document).on("click",".admin-feature-song", function(){
	var id = $(this).data('id'), user_id = $(this).data('user-id');
	FeatureSong(id, user_id, $(this), 1);
});
$(document).on("click",".admin-unfeature-song", function(){
	var id = $(this).data('id'), user_id = $(this).data('user-id');
	FeatureSong(id, user_id, $(this), 0);
});	

function FeatureSong(id, user_id, $obj, act){
	$.ajax({
		   type:'POST',
		   url:'/setfeaturedSong',
		   data:{ _token : $("#hidden_token").val(), id : id, user_id: user_id,act: act},
		   success:function(data){
				if(data.status == 1){
					if(act == 1)  //publish
					{
						$obj.removeClass("admin-feature-song");
						$obj.addClass("admin-unfeature-song");
						$obj.html("Unset Feature");
					}
					else{  //unpublish
						$obj.addClass("admin-feature-song");
						$obj.removeClass("admin-unfeature-song");
						$obj.html("Set Feature");
					}
					if(data.total == 1)
						$(".admin-feature-song").addClass("disabled");
					else
						$(".admin-feature-song").removeClass("disabled");
				}
				else{
					alert(data.msg);
				}
				
		   }
	});
	
}

   
   // admin news
    $(document).on("click",".admin-publish-news", function(){
		var id = $(this).data('id');
		publishNews(id, $(this), 1);
    });	
	
	$(document).on("click",".admin-unpublish-news", function(){
		var id = $(this).data('id');
		publishNews(id, $(this), 0);
    });
	
	function publishNews(id, $obj, act){
		$.ajax({
			   type:'POST',
			   url:'/publishNews',
			   data:{ _token : $("#hidden_token").val(), id : id,act: act},
			   success:function(data){
					if(data.status == 1){
						if(act == 1)  //publish
						{
							$obj.removeClass("admin-publish-news");
							$obj.addClass("admin-unpublish-news");
							$obj.html("Unpublish");
							$obj.closest(".odd.gradeX").find(".status").html("Published");
							
								
						}
						else{  //unpublish
							$obj.addClass("admin-publish-news");
							$obj.removeClass("admin-unpublish-news");
							$obj.html("Publish");
							$obj.closest(".odd.gradeX").find(".status").html("Unpublished");
						}
					}
					else{
						alert(data.msg);
					}
					
			   }
		});
		
	}


// admin comments
	
	 $(document).on("click",".admin-publish-comment", function(){
		var id = $(this).data('id');
		publishComments(id, $(this), 1);
    });	
	
	$(document).on("click",".admin-unpublish-comment", function(){
		var id = $(this).data('id');
		publishComments(id, $(this), 0);
    });
	
	function publishComments(id, $obj, act){
		$.ajax({
			   type:'POST',
			   url:'/publishComments',
			   data:{ _token : $("#hidden_token").val(), id : id,act: act},
			   success:function(data){
					if(data.status == 1){
						if(act == 1)  //publish
						{
							$obj.removeClass("admin-publish-comment");
							$obj.addClass("admin-unpublish-comment");
							$obj.html("Unpublish");
							$obj.closest(".odd.gradeX").find(".status").html("Published");	
						}
						else{  //unpublish
							$obj.addClass("admin-publish-comment");
							$obj.removeClass("admin-unpublish-comment");
							$obj.html("Publish");
							$obj.closest(".odd.gradeX").find(".status").html("Unpublished");
						}
					}
					else{
						alert(data.msg);
					}
					
			   }
		});
	}

// delete songs

		$(document).on('click', '.admin-trash-song', function(event){
				var r = confirm("Are you really delete this song?");
				if (r == false) {
					event.stopPropagation();
					event.preventDefault();
				}
				
		});
	

	
});