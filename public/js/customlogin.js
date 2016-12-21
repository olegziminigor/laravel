(function ($) {
	

/************************  This is for Google + ***********************************************/	
	
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '660037470921-sb8haskqijlighcnie3eajjhifh4utff.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('google-plus-btn'));
      
    });
  };

  function attachSignin(element) {

    auth2.attachClickHandler(element, {},
        function(googleUser) {
            $("#name").val(googleUser.getBasicProfile().getName());
            $("#email").val(googleUser.getBasicProfile().getEmail());
            $("#image").val(googleUser.getBasicProfile().getImageUrl());	
			
			if($(".signupinbtn").hasClass('signinbtn')){
				 $(".signinbtn").trigger("click"); 
			}
			else{
				
				$(".usertype-div").show(); 
				$(".signupbtn").show(); 
			}
		   
        }, function(error){
			
			alert(JSON.stringify(error, undefined, 2));
		  
        });
  }
  startApp();
  
  
/********************************  facebook ****************************************/

	window.fbAsyncInit = function() {
		FB.init({
		  appId      : '1607181296244314',
		  xfbml      : true,
		  version    : 'v2.8'
		});
	};

	  (function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "//connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	//secret id: ab860865bc8116d7976465eda654eacc
	//app id: 619310718257273

	}(document, 'script', 'facebook-jssdk'));


	$("#facebook-btn").click(function(){
		FB.login(function(response){
			if(response.status ==='connected'){
				FB.api('/me?fields=picture{url},first_name,last_name,email,about,birthday',function(response){
					
					$("#name").val(response.first_name + ' ' + response.last_name);
					$("#email").val(response.email);
					$("#image").val(response.picture.data.url);	
					$("#bio").val(response.about);
					//alert(response.email);
					console.log(response);
					
					if($(".signupinbtn").hasClass('signinbtn')){
						$(".signinbtn").trigger("click"); 
					}
					else{
											
						$(".usertype-div").show(); 
						$(".signupbtn").show(); 
					}
			
				},{scope: 'email'});
			}else if(response.status ==='not_authorized'){
				alert('not authorized');	
			}else{
				alert('Please login face book');	
			}		
	},{scope:'user_about_me'});
	});  
	
	
	
	/**************************total process ******************************/
	
	$(".signupbtn").click(function(event){
		if($("#usertype").val() == '-1'){
			$(".user-type-hint").show();
			event.stopPropagation();
			event.preventDefault();
		}
	});
	
  
 })(jQuery);