$(function() {
    $(".publish-comment-form").val("");
	
	$(".publish-comment").click(function(){
		
		var content = $(".publish-comment-form").val();
		var id = $(this).attr("data-post-id");
		var type = $(this).attr("data-post-type");
	
		if(content != ""){
			$.ajax({
				   type:'POST',
				   url:'/leavecomment',
				   data:{ _token : $("#hidden_token").val(), id : id, content: content, type: type},
				   success:function(data){
						if(data.status == 1){
							$(".publish-comment-form").val("");
							location.reload();
						}
						else{
							
						}
						
				   }
			});
		}
		else{
			
			alert("Please input the comment");
			
		}
		
		
	});
	
	
	
});