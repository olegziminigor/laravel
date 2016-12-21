@extends('menu')
@section('main_content')
  <div class="app-body" id="view">
	<!-- ############ PAGE START-->
	<div class="page-content">
	  <div class="row-col">
		<div class="col-lg-9 b-r no-border-md">
		  <div class="padding">
			
			
			<div class="page-title m-b">
			  <h1 class="inline m-a-0">Artists</h1>
			  <div class="dropdown inline">
				<button class="btn btn-sm no-bg h4 m-y-0 v-b dropdown-toggle text-primary" data-toggle="dropdown">By name</button>
				<div class="dropdown-menu">
				  <a href="#" class="dropdown-item active">
					By name
				  </a>
				  <a href="#" class="dropdown-item">
					Songs
				  </a>
				</div>
			  </div>
			</div>
			<div data-ui-jp="jscroll" data-ui-options="{
				autoTrigger: false,
				loadingHtml: '<i class=\'fa fa-refresh fa-spin text-md text-muted\'></i>',
				padding: 50,
				nextSelector: 'a.jscroll-next:last'
			  }">
			  <div class="row row-lg">
				
				@foreach($artists as $artist)
					<div class="col-xs-4 col-sm-4 col-md-3">
						<div class="item">
							<div class="item-media rounded ">
							<?php
								
								if($artist->image){
							?>
							
								<a href="/profile-details/<?php  

									$display_txt = $artist->name;
									echo str_slug($display_txt, '-');
								
							?>/{{$artist->id}}"  class="item-media-content" style="background-image: url('<?php  	
									if (strpos($artist->image,"http") !== false) {
										echo $artist->image;
									}
									else  echo asset($artist->image);
									
									?>');"></a>
									
								
									
							<?php
								}
								else{
							?>
						
							<a   href="/profile-details/<?php  

									$display_txt = $artist->name;
									echo str_slug($display_txt, '-');
								
							?>/{{$artist->id}}" class="item-media-content" style="background-image: url('images/no_image.jpg');"></a>
							<?php
								}
							?>
							</div>
							<div class="item-info text-center">
								<div class="item-title text-ellipsis">
									<a href="profile-details/<?php  

									$display_txt = $artist->name;
									echo str_slug($display_txt, '-');
								
							?>/{{$artist->id}}">{{$artist->name}}</a>
									<div class="text-sm text-muted"> 
										<?php
											foreach($counts as $count){
												
												if($count['artise_id'] == $artist['id']){
													echo $count['item_count'].' songs';
													break;
												} 
												
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach	
					
					
			  </div>
			  <a href="scroll.author.html" class="btn btn-sm white rounded jscroll-next">Show More</a>
			</div>

		  </div>
		</div>
		
		@include('like')
	  </div>
	</div>
	<!-- ############ PAGE END-->
  </div>
@stop  
  