
@extends('menu')
@section('main_content')

<div class="app-body" id="view">

<!-- ############ PAGE START-->

<div class="page-content">
  <div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
      <div class="padding">
        

        <div class="page-title m-b">
          <h1 class="inline m-a-0">{{$lyric->title}}</h1>
        </div>
		
							
        <div data-ui-jp="jscroll" class="jscroll-loading-center" data-ui-options="{
            autoTrigger: true,
            loadingHtml: '<i class=\'fa fa-refresh fa-spin text-md text-muted\'></i>',
            padding: 50,
            nextSelector: 'a.jscroll-next:last'
          }">
      		<div class="row-col">
			
			
				<div class="col-xs-4 col-sm-4 col-md-3">
					<div class="item r" data-id="{{$lyric->id}}">
					
						<div class="col-md-12 text-sm text-ellipsis" style = "color: #aaa;font-size: 20px;">
											
								{{$lyric->artise_name}}
						
						
						</div>  
						
						  @include('share')
						  
						<div class="col-md-12" style = "text-align:center">
							<img width = "400" class="item-media-content" src="<?php echo asset('server/php/files/'.$lyric->image) ?>"  style = "position: relative;" />
							<br>
						</div>
						
						<div class="col-md-12">
						
						
							<?php
								$display_txt = $lyric->content;
								echo str_replace("\n","<br />",$display_txt);
								?>
							
						</div>						
					</div>
      			</div>
      		</div>
		<?php
		if(0){
		?>
          <div class="text-center">
			
  		      <a href="scroll.item.html" class="btn btn-sm white rounded jscroll-next">Show More</a>
          </div>
		<?php 
		}
		?>
        </div>

      </div>
   
		<div class = "padding">
			
			  <h5 class="m-b">Comments</h5>
			    <div class="streamline m-b m-l">
					@foreach($comments as $comment)	
					  <div class="sl-item">
						<div class="sl-left">
						
						  <img src="{{$comment->image}}" class="img-circle">
						
						  
						</div>
						<div class="sl-content">
						  
						  <div class="sl-author m-b-0">
							<a href="#">{{$comment->name}}</a>
							<span class="sl-date text-muted">
								<?php
				
					$date = new DateTime($comment->updated_at);
					$time_diff = time() - $date->getTimestamp();
					$min_diff = 60;
					$hour_diff = 3600;
					$day_diff = 86400;
					$week_diff  = 604800;
					$month_diff = 2592000;
					$year_diff = 31536000;
				
					$ret_val = floor($time_diff/$year_diff);
					if($ret_val) echo $ret_val.' years ago';
					else{
						$ret_val = floor($time_diff/$month_diff);
						if($ret_val) echo $ret_val.' months ago';
						else{
							$ret_val = floor($time_diff/$week_diff);
							if($ret_val) echo $ret_val.' weeks ago';
							else{
								$ret_val = floor($time_diff/$day_diff);
								if($ret_val) echo $ret_val.' days ago';
								else{
									$ret_val = floor($time_diff/$hour_diff);
									if($ret_val) echo $ret_val.' hours ago';
									else{
										$ret_val = floor($time_diff/$min_diff);
										if($ret_val) echo $ret_val.' mins ago';
										else
											echo $ret_val.' seconds ago';
									}
								}
							}
						}
					}
					
				?>
							</span>
						  </div>
						  <div>
							<p> {{$comment->content}} </p>
						  </div>
						  
						</div>
					  </div>
					
					 @endforeach
				</div>
			  
			  
			@if (Auth::check()) 
			  
			  <h5 class="m-t-lg m-b">Leave a comment</h5>
			  
			  
			  <div class = "padding">
					 <div class="box m-a-0 b-a">
						<form>
						  <textarea class="form-control no-border publish-comment-form" rows="3" placeholder="Type something..."></textarea>
						</form>
						<div class="box-footer clearfix">
						  <button data-post-id = "<?php echo $lyric->id; ?>" class="btn btn-info pull-right btn-sm publish-comment" data-post-type = '1'>Post</button>
						  <ul class="nav nav-pills nav-sm">
							<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-camera text-muted"></i></a></li>
							<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-video-camera text-muted"></i></a></li>
						  </ul>
						</div>
					  </div>
				</div>
	
			@endif
		
		</div>
		

   </div>
    
	@include('like')
	
	
 </div>
  
</div>

<!-- ############ PAGE END-->

</div>
 
@stop