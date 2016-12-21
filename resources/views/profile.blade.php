
@extends('menu')
@section('main_content')
@if(Auth::check())
	@include('function')
@endif


    <div class="app-body" id="view">

<!-- ############ PAGE START-->
<div class="page-bg" data-stellar-ratio="2" style="background-image: url('images/a3.jpg');"></div>
<div class="page-content">
  <div class="padding b-b">
    <div class="row-col">
        <div class="col-sm w w-auto-xs m-b">
          <div class="item w rounded">
            <div class="item-media">
              <div class="item-media-content user-profile-image" style="background-image: url('{{Auth::user()->image}}');"></div>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="p-l-md no-padding-xs">
            <h1 class="page-title">
              <span class="h1 _800">{{Auth::user()->name}}</span>
            </h1>
            <p class="item-desc text-ellipsis text-muted" data-ui-toggle-class="text-ellipsis">
			
				{{Auth::user()->BIO}}
			
			</p>
            <div class="item-action m-b">
              <a href="#" class="btn btn-sm rounded primary upload-profileimage">Upload Image</a>			  
              <!--a href="#" class="btn btn-sm rounded white">Update Profile</a-->
            </div>
			@if(Auth::user()->usertype == 1 || Auth::user()->usertype == 2 )
            <div class="block clearfix m-b">
              <!--span>9</span> <span class="text-muted">Albums</span>, <span>23</span> <span class="text-muted">Tracks</span-->
              <span><?php echo count($track_songs);  ?></span> <span class="text-muted">Tracks</span>
            </div>
            @endif
          </div>
		  
		    <div class="col-sm-9 uploadimage-form" style  = "display:none">
				<span class="btn btn-success fileinput-button">
					<i class="glyphicon glyphicon-plus"></i>
					<span>Update Image...</span>
					<!-- The file input field used as target for the file upload widget -->
					<input id="fileupload_profile" type="file" name="files" multiple>
				</span>
						
				<br>
				<br>
				<!-- The global progress bar -->
				<div id="progress_profile" class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<!-- The container for the uploaded files -->
				<div id="files_upload_profile" class="files"></div>
				<input type = "hidden"  id = "uploadprofile_src" />
				<br>
			</div>
			 
		  
        </div>
    </div>
  </div>

  
			 
  
  <div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
      <div class="padding p-y-0 m-b-md">
        <div class="nav-active-border b-primary bottom m-b-md m-t">
          <ul class="nav l-h-2x" data-ui-jp="taburl">
		  
			<?php  
				
				$categories = ['track', 'playlist', 'like', 'profile'];
				
				if(isset($_GET['show'])){
					$active = $_GET['show'];
				}
				else{
					$active = 'profile';
				}
				
				foreach($categories as $item){
					
			?>	
				<li class="nav-item m-r inline">
				  <a class="nav-link <?php if($active == $item) echo 'active'; ?>" href="#" data-toggle="tab" data-target="#<?php echo $item;  ?>"><?php echo $item;  ?>s</a>
				</li>
			<?php		
					
				}
				
			?>
			
			
			<?php ?>
          </ul>
        </div>
        
        <div class="tab-content">
		
			<div class="tab-pane <?php if($active == 'track') echo 'active'; ?>" id="track">
				<div class="row item-list item-list-by m-b">
					
					@foreach($track_songs as $song)
					
					<div class="col-xs-12 profile-itemsong">
					  
						<div class="item r" data-id="{{$song->id}}" data-src="server/php/files/{{$song->source}}">
							<div class="item-media ">
								
								<a href="/trackdetail/<?php 
									$display_txt = $song->title;
									echo str_replace(" ","-",$display_txt);
								
								?>/{{$song->id}}" class="item-media-content" style="background-image: url('server/php/files/{{$song->image}}');"></a>
						
								
						
								<div class="item-overlay center">
									<button  class="btn-playpause">Play</button>
								</div>
							</div>
							
							
							
							<div class="item-info">
								<div class="item-overlay bottom text-right">
								
								<a href="#" class="btn-favorite profile <?php  		
									if(Auth::check()){
										$ret_val = find_favorite($favorite_songsbyuser, $song->id);
										if($ret_val) echo 'is-like';
									}		
								?>"><i class="fa fa-heart-o"></i></a>
								<a href="#" class="btn-more profile" data-toggle="dropdown"  data-downloadsrc = "server/php/files/{{$song->source}}" data-id="{{$song->id}}"><i class="fa fa-ellipsis-h"></i></a>
									
									<div class="dropdown-menu pull-right black lt"></div>
								</div>
								<div class="item-title text-ellipsis">
								
									<a href="/trackdetail/<?php 
										$display_txt = $song->title;
										echo str_replace(" ","-",$display_txt);
									
									?>/{{$song->id}}"> {{$song->title}}</a>
									
								</div>
								
								
								<div class="item-action visible-list m-t-sm">
									<a href="/deletesongitem/{{$song->id}}" class="btn btn-xs white delete-item-btn" data-id ="{{$song->id}}" data-toggle="modal" data-target="#delete-modal">Delete</a>
								</div>
							</div>
						</div>
					</div>
				
					@endforeach
				
				</div>
		   
          </div>
         		
			  <div class="tab-pane <?php if($active == 'playlist') echo 'active'; ?>" id="playlist">
				<div class="row m-b">
				
				@if (Auth::check())
					@foreach($playlist_songs as $song)
				
				
				
					  <div class="col-xs-4 col-sm-4 col-md-3 profile-itemsong">
						<div class="item r" data-id="{{$song->id}}" data-src="server/php/files/{{$song->source}}">
							<div class="item-media ">
								
								<a href="/trackdetail/<?php 
									$display_txt = $song->title;
									echo str_replace(" ","-",$display_txt);
								
								?>/{{$song->id}}" class="item-media-content" style="background-image: url('server/php/files/{{$song->image}}');"></a>
								
						
						
								<div class="item-overlay center">
									<button  class="btn-playpause">Play</button>
								</div>
							</div>
							<div class="item-info">
								<div class="item-overlay bottom text-right">
									
									<a href="#" class="btn-favorite profile <?php  		
									if(Auth::check()){
										$ret_val = find_favorite($favorite_songsbyuser, $song->id);
										if($ret_val) echo 'is-like';
									}		
									?>"><i class="fa fa-heart-o"></i></a>
									<a href="#" class="btn-more profile" data-toggle="dropdown"  data-downloadsrc = "server/php/files/{{$song->source}}" data-id="{{$song->id}}"><i class="fa fa-ellipsis-h"></i></a>
									
									
									<div class="dropdown-menu pull-right black lt"></div>
								</div>
								<div class="item-title text-ellipsis">
								
									<a href="/trackdetail/<?php 
										$display_txt = $song->title;
										echo str_replace(" ","-",$display_txt);
									
									?>/{{$song->id}}"> {{$song->title}}</a>
									
								</div>
								<div class="item-author text-sm text-ellipsis hide">
								
									<a href="artistdetail/<?php 
										$display_txt = $song->name;
										echo str_replace(" ","-",$display_txt);
									
									?>/{{$song->artise_id}}" class="text-muted">{{$song->name}}</a>
						
								</div>
								
								
								<div class="item-meta text-sm text-muted">
								  <span class="item-meta-stats text-xs ">
									
									<i class="fa fa-heart m-l-sm text-muted"></i>  <?php echo $song->fav_count; ?>
								  </span>
								</div>
				  
				  
							</div>
						</div>
					 </div>
					@endforeach     
				@endif
				
				</div>
			  </div>
			  <div class="tab-pane <?php if($active == 'like') echo 'active'; ?>" id="like">
				<div class="row m-b">
				@if (Auth::check())
					@foreach($favorite_songs as $song)
					  <div class="col-xs-4 col-sm-4 col-md-3 profile-itemsong">

						<div class="item r" data-id="{{$song->id}}" data-src="server/php/files/{{$song->source}}">
							<div class="item-media ">
								
								<a href="/trackdetail/<?php 
									$display_txt = $song->title;
									echo str_replace(" ","-",$display_txt);
								
								?>/{{$song->id}}" class="item-media-content" style="background-image: url('server/php/files/{{$song->image}}');"></a>
						
						
								
								
								<div class="item-overlay center">
									<button  class="btn-playpause">Play</button>
								</div>
							</div>
							<div class="item-info">
								<div class="item-overlay bottom text-right">
									
									<a href="#" class="btn-favorite profile <?php  		
									if(Auth::check()){
										$ret_val = find_favorite($favorite_songsbyuser, $song->id);
										if($ret_val) echo 'is-like';
									}		
									?>"><i class="fa fa-heart-o"></i></a>
									<a href="#" class="btn-more profile" data-toggle="dropdown"  data-downloadsrc = "server/php/files/{{$song->source}}" data-id="{{$song->id}}"><i class="fa fa-ellipsis-h"></i></a>
									
									
									<div class="dropdown-menu pull-right black lt"></div>
								</div>
								<div class="item-title text-ellipsis">
									<a href="/trackdetail/<?php 
										$display_txt = $song->title;
										echo str_replace(" ","-",$display_txt);
									
									?>/{{$song->id}}"> {{$song->title}}</a>
						
						
						
								</div>
								<div class="item-author text-sm text-ellipsis hide">
									<a href="artistdetail.html" class="text-muted"></a>
								</div>
								<div class="item-meta text-sm text-muted">
								  <span class="item-meta-stats text-xs ">
									<i class="fa fa-heart m-l-sm text-muted"></i>  <?php echo $song->fav_count; ?>
									
								  </span>
								</div>
				  
				  
							</div>
						</div>
					 </div>
					@endforeach     
				@endif
				
				</div>
			  </div>
			  <div class="tab-pane <?php if($active == 'profile') echo 'active'; ?>" id="profile">
           
			<form role = "form" method = "POST" action="{{ url('/updateprofile') }}">
				<div class="form-group row">
					<div class="col-sm-3 form-control-label text-muted">Name</div>
					<div class="col-sm-9"><input name = "account_name" type = "textbox" value="{{Auth::user()->name}}" class="form-control"></div>
				</div>
				<div class="form-group row">
				  <div class="col-sm-3 form-control-label text-muted">Bio</div>
				  <div class="col-sm-9">
					<textarea name = "account_bio" class="form-control" rows="5" id="bio">{{Auth::user()->BIO}}</textarea>
				  </div>
				</div>

				<div class="form-group row">
					<div class="col-sm-3 form-control-label text-muted">Country</div>
					<div class="col-sm-9"><input name = "account_country" id = "account_country" class="form-control" value = "{{Auth::user()->country}}"></div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-3 form-control-label text-muted">Website</div>
					<div class="col-sm-9"><input name = "account_website" id = "account_website" placeholder="http://" class="form-control" value = "{{Auth::user()->website}}"></div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-3 form-control-label text-muted">Phone Number</div>
					<div class="col-sm-9"><input id = "account_phone" name = "account_phone" class="form-control" value = "{{Auth::user()->phone}}"></div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-3 form-control-label text-muted">Face book Fan page</div>
					<div class="col-sm-9"><input name = "account_fanpage" id = "account_fanpage" placeholder="http://" class="form-control" value = "{{Auth::user()->fb}}"></div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-3 form-control-label text-muted">Twitter</div>
					<div class="col-sm-9"><input name = "account_twitter" id= "account_twitter" placeholder="http://" class="form-control" value = "{{Auth::user()->tw}}"></div>
				</div>
				
				<div class="form-group row">
					<div class="col-sm-3 form-control-label text-muted">Instagram</div>
					<div class="col-sm-9"><input name = "account_inst" id = "account_inst" placeholder="http://" class="form-control" value = "{{Auth::user()->ist}}"></div>
				</div>
				
				{{ csrf_field() }}
				
				<div style = "text-align: center">
				<button id = "update_profile" type="submit" class="btn btn-fw success">Save</button>
				</div>
				
            </form>
          </div>
        </div>
      </div>
    </div>
    
	@include('like')
	
  
  </div>
</div>

<!-- .modal -->
<div id="delete-modal" class="modal fade animate black-overlay" data-backdrop="false">
  <div class="row-col h-v">
    <div class="row-cell v-m">
      <div class="modal-dialog modal-sm">
        <div class="modal-content flip-y">
          <div class="modal-body text-center">          
            <p class="p-y m-t"><i class="fa fa-remove text-warning fa-3x"></i></p>
            <p>Are you sure to delete this item?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default p-x-md" data-dismiss="modal">No</button>
            <a  class="btn red p-x-md delte-item delete-songitem"  data-dismiss="modal">Yes</a>
          </div>
        </div><!-- /.modal-content -->
      </div>
    </div>
  </div>
</div>
<!-- / .modal -->

<!-- ############ PAGE END-->

    </div>
 
 @stop