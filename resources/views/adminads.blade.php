@extends('adminmenu')@section('admin_content')	 <div class="col-md-10">	  <div class="content-box-large">		<div class="panel-heading">		  <div class="panel-title">Ads<br>			<br>			Sort By : Publish | Unpublished | Trash</div>		</div>		<div class="panel-body">		  <table class="table table-striped table-bordered" id="example" border="0"			cellpadding="0"			cellspacing="0">			<thead>			  <tr>				<th>Ads Title</th>				<th>Status</th>				<th>Total Clicks</th>				<th>Action</th>			  </tr>			</thead>			<tbody>			  <tr class="odd gradeX">				<td>Home page banner</td>				<td>Published</td>				<td>120</td>				<td>&nbsp;Unpublish - Trash </td>			  </tr>			</tbody>		  </table>		  <div class="panel-heading">			<div class="panel-title">Insert Ads<br>			</div>			<div class="panel-options"> </div>		  </div>		  <div class="navbar">			<div class="navbar-inner">			  <div class="container">				<ul class="nav nav-pills">				  <li class="active"><a href="#" data-toggle="tab">Homepage</a></li>				  <li><a href="#" data-toggle="tab"><span style="color: #2a6496;">Browse</span></a></li>				  <li><a href="#" data-toggle="tab">Chart</a></li>				  <li><a href="#" data-toggle="tab">Artists / Profile</a></li>				  <li><a href="#" data-toggle="tab">Login/Signup</a></li>				  <li><a href="#" data-toggle="tab">Music/Lyrics</a></li>				  <li><a href="#" data-toggle="tab">News Page</a></li>				</ul>			  </div>			</div>		  </div>		  <div class="tab-pane active" id="tab1">			<form class="form-horizontal" role="form">			  <div class="form-group"> <label for="inputEmail3" class="col-sm-2 control-label">Title</label>				<div class="col-sm-10"> <input class="form-control" id="inputEmail3"					placeholder="Title"					type="email">				</div>			  </div>			  <div class="form-group"> <label for="inputPassword3" class="col-sm-2 control-label">URL
				  (optional)</label>				<div class="col-sm-10"> <input class="form-control" id="url"					placeholder="URL"					type="text">				</div>			  </div>			  <div class="form-group"> <label for="inputPassword3" class="col-sm-2 control-label">Adsense				  code (optional)</label>				<div class="col-sm-10"> <input class="form-control" id="code"					placeholder="ad code"					type="text">				</div>			  </div>			  <div class="form-group"> <label class="col-sm-2 control-label">Upload
				  Image</label>				<div class="col-md-10"> <input class="btn btn-default" id="exampleInputFile1"					type="file">				</div>			  </div>			  <div class="form-group">				<div class="col-sm-offset-2 col-sm-10">				  <div class="checkbox"> <label> <input type="checkbox">					  Header </label> </div>				  <div class="checkbox"> <label> <input type="checkbox">					  Sidebar </label> </div>				  <div class="checkbox"> <label> <input type="checkbox">					  Middle </label> </div>				  <div class="checkbox"> <label> <input type="checkbox">					  Footer </label> </div>				</div>			  </div>			</form>		  </div>		  <ul class="pager wizard">			<li class="next"><a href="javascript:void(0);">Add</a></li>		  </ul>		</div>	  </div>	</div>@stop     