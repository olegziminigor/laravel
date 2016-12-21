(function ($) {

$(window).load(function() {
	$(".upload_guestbutton").click(function(){
		$(".userlogin").trigger("click");	
	});
		
	$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'http://africa.triche-osborne.com/server/php/',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function (event) {
				event.stopPropagation();
				event.preventDefault();
					
					
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit(function (event) {
					event.stopPropagation();
					event.preventDefault();
                    $this.remove();
                });
            });
	
	
	
	$(document).on("click",'#fileupload_profile', function(){
		//$(document).on('fileupload', '#fileupload_profile', function(){}
		$('#fileupload_profile').fileupload({
			url: url,
			dataType: 'json',
			autoUpload: false,
			acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
			maxFileSize: 999000,
			// Enable image resizing, except for Android and Opera,
			// which actually support image resizing, but fail to
			// send Blob objects via XHR requests:
			disableImageResize: /Android(?!.*Chrome)|Opera/
				.test(window.navigator.userAgent),
			previewMaxWidth: 100,
			previewMaxHeight: 100,
			previewCrop: true,
			
		}).on('fileuploadadd', function (e, data) {
			$('#files_upload_profile').html("");
			$('#progress_profile .progress-bar').css(
				'width', "0%"
			);
			
			data.context = $('<div/>').appendTo('#files_upload_profile');
			
			$.each(data.files, function (index, file) {
				var node = $('<p/>')
						.append($('<span/>').text(file.name));
				if (!index) {
					node
						.append('<br>')
						.append(uploadButton.clone(true).data(data));
				}
				node.appendTo(data.context);
			});
		}).on('fileuploadprocessalways', function (e, data) {
			var index = data.index,
				file = data.files[index],
				node = $(data.context.children()[index]);
			if (file.preview) {
				node
					.prepend('<br>')
					.prepend(file.preview);
			}
			if (file.error) {
				node
					.append('<br>')
					.append($('<span class="text-danger"/>').text(file.error));
			}
			if (index + 1 === data.files.length) {
				data.context.find('button')
					.text('Upload')
					.prop('disabled', !!data.files.error);
			}
		}).on('fileuploadprogressall', function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress_profile .progress-bar').css(
				'width',
				progress + '%'
			);
		}).on('fileuploaddone', function (e, data) {
			$.each(data.result.files, function (index, file) {
				if (file.url) {
					var link = $('<a>')
						.attr('target', '_blank')
						.prop('href', file.url);
					$(data.context.children()[index])
						.wrap(link);
					$("#files_upload_profile").find(".btn.btn-primary").remove();
					$('#files_upload_profile').html("");
					
				
					
						//ajax
			
			$.ajax({
				type:'POST',
				url:'/saveimage',
				data:{ _token : $("#hidden_token").val(), filename : file.name},
				success:function(data){
					if(data.status == '1'){
						$(".user-profile-image").css("background-image", "url('server/php/files/" + file.name + "')");
						$(".user-profile-image-span").html('<img src="server/php/files/'+ file.name + '" alt="...">');

					}
					else{
						alert(data.msg);
					}
			   }
			});
				
				
					
				} else if (file.error) {
					var error = $('<span class="text-danger"/>').text(file.error);
					$(data.context.children()[index])
						.append('<br>')
						.append(error);
				}
			});
		}).on('fileuploadfail', function (e, data) {
			$.each(data.files, function (index) {
				var error = $('<span class="text-danger"/>').text('File upload failed.');
				$(data.context.children()[index])
					.append('<br>')
					.append(error);
			});
		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');
		
	});
	
		
	$(document).on("click", ".upload-profileimage", function(){
		
		$(".uploadimage-form").show();
		
	});
		
		
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
		$('#files_upload').html("");
		$('#progress_image .progress-bar').css(
            'width', "0%"
        );
		
        data.context = $('<div/>').appendTo('#files_upload');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
					
				
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress_image .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
				$("#files_upload").find(".btn.btn-primary").remove();
				$("#uploadsong_img").val(file.name);
				
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


 $('#fileupload_song').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(mp3)$/i,
      //  maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
		$('#files_upload_song').html("");
		$('#progress_song .progress-bar').css(
            'width', "0%"
        );
		
        data.context = $('<div/>').appendTo('#files_upload_song');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress_song .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
				$("#files_upload_song").find(".btn.btn-primary").remove();
				
				$("#uploadsong_src").val(file.name);
				
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		
	//validation proecessing
	init();
	function init(){
		
		$("#title-upload-song").val("");
		$("#uploadsong_src").val("");
		$("#uploadsong_img").val("");
		$("#title-upload-song_riryc").val("");
		$("#lyrics_content").val("");
		$("#lyrics_artise_name").val("");
		$("#uploadsong_img_riryc").val("");
	}
	
	$("#uploadsong_save").click(function(event){
		
		event.preventDefault();
		var error  = 0;
		if($("#title-upload-song").val() == "") error  = 1;
		if(!error && $("#uploadsong_src").val() == "") error = 2;
		if(!error && $("#uploadsong_img").val() == "") error = 3;
		
		if(error){
			switch(error){
				case 1: alert("Please insert the song title"); break;
				case 2: alert("Please upload the song."); break;
				case 3: alert("Please upload the cover image"); break;
			}
		}
		else{
			$.ajax({
			   type:'POST',
			   url:'/uploadsong',
			   data:{ _token : $("#hidden_token").val(), title_upload_song : $("#title-upload-song").val(), uploadsong_src : $("#uploadsong_src").val(), uploadsong_img: $("#uploadsong_img").val()},
			   success:function(data){
					if(data.status == '1'){
						$(".uploadsong-alert").show();
						
						$(".form-control").val('');
						$('.progress-bar').css(
							'width', "0%"
						);
						$('.upload-content').html("");
		
					}
					else{
						alert(data.msg);
					}
					
			   }
			});
			
		}
		
	});
	

	/***************upload ryric  ******************************/
	
	$("#uploadsong_save_riryc").click(function(event){
		
		event.preventDefault();
		var error  = 0;
		if($("#title-upload-song_riryc").val() == "")        error  = 1;
		if(!error && $("#lyrics_content").val() == "")       error  = 2;
		if(!error && $("#lyrics_artise_name").val() == "")   error  = 3;
		if(!error && $("#uploadsong_img_riryc").val() == "") error  = 4;
		
		if(error){
			switch(error){
				case 1: alert("Please insert the ryric title"); break;
				case 2: alert("Please input the lyric."); break;
				case 3: alert("Please input the artise name"); break;
				case 4: alert("Please upload the cover image"); break;
			}
			//event.preventDefault();
		}
		else{
			
			$.ajax({
			   type:'POST',
			   url:'/uploadryric',
			   data:{ _token : $("#hidden_token").val(), title_upload_song_riryc : $("#title-upload-song_riryc").val(), lyrics_content : $("#lyrics_content").val(), lyrics_artise_name : $("#lyrics_artise_name").val(), uploadsong_img_riryc : $("#uploadsong_img_riryc").val()},
			   success:function(data){
					if(data.status == '1'){
						$(".uploadlyric-alert").show();
						
						$(".form-control").val('');
						$('.progress-bar').css(
							'width', "0%"
						);
						$('.upload-content').html("");
					}
					else{
						alert(data.msg);
					}
					
			   }
			});
			
		}
		
		
		
		
	});
	
	 $('#fileupload_riryc').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
		$('#files_upload_riryc').html("");
		$('#progress_image_riryc .progress-bar').css(
            'width', "0%"
        );
		
        data.context = $('<div/>').appendTo('#files_upload_riryc');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
					
				
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress_image_riryc .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
				$("#files_upload_riryc").find(".btn.btn-primary").remove();
				$("#uploadsong_img_riryc").val(file.name);
				
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


	/***************upload news ******************************/

//fileupload_riryc  :  fileupload_news
//progress_image_riryc : progress_image_news
//uploadsong_img_riryc  :  uploadnews_img
//files_upload_riryc    :  files_upload_news
	$('#fileupload_news').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
		$('#files_upload_news').html("");
		$('#progress_image_news .progress-bar').css(
            'width', "0%"
        );
		
        data.context = $('<div/>').appendTo('#files_upload_news');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
					
				
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress_image_news .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
				$("#files_upload_news").find(".btn.btn-primary").remove();
				$("#uploadnews_img").val(file.name);
				
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
   //uploadnews_save
	
	$("#uploadnews_save").click(function(event){
		var error  = 0;
		if($("#title_upload_news").val() == "")        error  = 1;
		if(!error && $("#news_content").val() == "")       error  = 2;
		//if(!error && $("#uploadnews_img").val() == "")   error  = 3;
		if(!error && $("#uploadsong_img_riryc").val() == "") error  = 4;
		
		if(error){
			switch(error){
				case 1: alert("Please insert the ryric title"); break;
				case 2: alert("Please input the lyric."); break;
				case 3: alert("Please input the artise name"); break;
				case 4: alert("Please upload the cover image"); break;
			}
			event.preventDefault();
		}
		
	});
	
	
	$(document).on("click",".modal-close-btn", function(){
		$(".form-control").val('');
		$(".alert-success").hide();
		
		$(".form-control").val('');
		$('.progress-bar').css(
			'width', "0%"
		);
		$('.upload-content').html("");
	});
});
/*jslint unparam: true, regexp: true */
/*global window, $ */

	
	
})(jQuery);
