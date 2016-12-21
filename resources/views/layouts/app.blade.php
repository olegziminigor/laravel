<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

	
	<meta name="description" content="Music, Musician, Bootstrap" />
	

	  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
	  <meta name="apple-mobile-web-app-capable" content="yes">
	  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
	  <link rel="apple-touch-icon" href="images/logo.png">
	  <meta name="apple-mobile-web-app-title" content="Flatkit">
	  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
	  <meta name="mobile-web-app-capable" content="yes">
	  <link rel="shortcut icon" sizes="196x196" href="images/logo.png">
	
	  <!-- style -->
	  <link rel="stylesheet" href="css/animate.css/animate.min.css" type="text/css" />
	  <link rel="stylesheet" href="css/glyphicons/glyphicons.css" type="text/css" />
	  <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" />
	  <link rel="stylesheet" href="css/material-design-icons/material-design-icons.css" type="text/css" />
	  <link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.min.css" type="text/css" />

	  <!-- build:css css/styles/app.min.css -->
	  <link rel="stylesheet" href="css/styles/app.css" type="text/css" />
	  <link rel="stylesheet" href="css/styles/style.css" type="text/css" />
	  <link rel="stylesheet" href="css/styles/font.css" type="text/css" />
	  
	  <link rel="stylesheet" href="libs/owl.carousel/dist/assets/owl.carousel.min.css" type="text/css" />
	  <link rel="stylesheet" href="libs/owl.carousel/dist/assets/owl.theme.css" type="text/css" />
	  <link rel="stylesheet" href="libs/mediaelement/build/mediaelementplayer.min.css" type="text/css" />
	  <link rel="stylesheet" href="libs/mediaelement/build/mep.css" type="text/css" />
  
	
	
    <!-- Styles -->
    
	
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
	<div class="app dk" id="app">
	
		<!-- ############ LAYOUT START-->
		<div class="padding">
			<div class="navbar">
			  <div class="pull-center">
				<!-- brand -->
				<a href="/home" class="navbar-brand md">
					
					<img src="images/logo.png" alt=".">
					<span class="hidden-folded inline">Africa Worship</span>
				</a>
				<!-- / brand -->
			  </div>
			</div>
		  </div>
<!-- ############ LAYOUT END-->					
	       @yield('content')
    </div>
		
    <!-- Scripts -->
	
	<!-- build:js scripts/app.min.js -->
<!-- jQuery -->
  <script src="libs/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="libs/tether/dist/js/tether.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="libs/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="libs/jquery.stellar/jquery.stellar.min.js"></script>
  <script src="libs/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="libs/jscroll/jquery.jscroll.min.js"></script>
  <script src="libs/PACE/pace.min.js"></script>
  <script src="libs/jquery-pjax/jquery.pjax.js"></script>

  <script src="libs/mediaelement/build/mediaelement-and-player.min.js"></script>
  <script src="libs/mediaelement/build/mep.js"></script>
  <script src="scripts/player.js"></script>

  <script src="scripts/config.lazyload.js"></script>
  <script src="scripts/ui-load.js"></script>
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>
  <script src="scripts/ui-taburl.js"></script>
  <script src="scripts/app.js"></script>
  <script src="scripts/site.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->
	
    <script src="/js/app.js"></script>
	<script src="https://apis.google.com/js/api:client.js"></script>
    <script src="/js/customlogin.js"></script>
	
</body>
</html>
