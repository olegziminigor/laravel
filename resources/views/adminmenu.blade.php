<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
    <title>AfricaWorship</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css"
      rel="stylesheet"
      media="screen">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/stats.css" rel="stylesheet">
	
	<link rel="stylesheet" href="css/jquery.fileupload.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>    <![endif]-->
  </head>
  <body>
    <div class="header">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <!-- Logo -->
            <div class="logo">
              <h1><a href="/home">Africa Worships</a></h1>
            </div>
          </div>
        
          <div class="col-md-5">
            <div class="navbar navbar-inverse" role="banner">
              <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right"
                role="navigation">
                <ul class="nav navbar-nav">
                  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      Account </a>
                    <ul class="dropdown-menu animated fadeInUp">
                      <li><a href="/home">Go to Front End</a></li>
                      <li><a href="{{ url('/logout') }}" >Logout</a></li>
					
					
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="row">
        <div class="col-md-2">
          <div class="sidebar content-box" style="display: block;">
            <ul class="nav">
              <!-- Main menu -->
              <li><a class="current" href="/adminhome"> Dashboard</a></li>
              <li><a href="/adminmusic"> Music</a></li>
              <li><a href="/adminlyrics"> Lyrics </a></li>
              <li><a href="/adminnews"> News</a></li>
              <li><a href="/admincomments"> Comments</a></li>
              <li><a href="/adminads"> Ads</a></li>
              <li><a href="/adminusers"> Users</a></li>
            </ul>
          </div>
        </div>
       
	   <?php
						
		echo '<input id = "hidden_token" type = "hidden" value = "'. csrf_token().'" name = "_token">';

		?>	
	   
	   @yield('admin_content');
      </div>
    </div>
    <footer>
      <div class="container">
        <div class="copy text-center"> Copyright 2016 <a href="#">Website</a> </div>
      </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="vendors/morris/morris.css">
	
<!-----------------------for file upload -------------->
	<script src="js/vendor/jquery.ui.widget.js"></script>
	<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
	<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <script src="js/jquery.iframe-transport.js"></script>
	<script src="js/jquery.fileupload.js"></script>
	<script src="js/jquery.fileupload-process.js"></script>
	<script src="js/jquery.fileupload-image.js"></script>
	<script src="js/jquery.fileupload-audio.js"></script>
	<script src="js/jquery.fileupload-validate.js"></script>

	<script src="scripts/upload.js"></script>

    <script src="vendors/jquery.knob.js"></script>
    <script src="vendors/raphael-min.js"></script>
    <script src="vendors/morris/morris.min.js"></script>
    <script src="vendors/flot/jquery.flot.js"></script>
    <script src="vendors/flot/jquery.flot.categories.js"></script>
    <script src="vendors/flot/jquery.flot.pie.js"></script>
    <script src="vendors/flot/jquery.flot.time.js"></script>
    <script src="vendors/flot/jquery.flot.stack.js"></script>
    <script src="vendors/flot/jquery.flot.resize.js"></script>

    <script src="js/custom.js"></script>
	
  </body>
</html>
