
@extends('menu')
@section('main_content')

<div class="app-body" id="view">

<!-- ############ PAGE START-->

<div class="page-content">
  <div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
      <div class="padding">
        <div class="page-title m-b">
          <h1 class="inline m-a-0">{{$news->title}}</h1>
        </div>
		
		
				
		  @include('share')		
		
		
        <div data-ui-jp="jscroll" class="jscroll-loading-center" data-ui-options="{
            autoTrigger: true,
            loadingHtml: '<i class=\'fa fa-refresh fa-spin text-md text-muted\'></i>',
            padding: 50,
            nextSelector: 'a.jscroll-next:last'
          }">
      		<div class="row-col">
			
				<div class="col-xs-4 col-sm-4 col-md-3">
					<div class="item r" data-id="{{$news->id}}">
						
						
						<div class="col-md-12" style = "height:300px;">
							<img width = "400" class="item-media-content" src="<?php echo asset('server/php/files/'.$news['image']) ?>" />
							
							<br>
						</div>
						<div class="col-md-12">
							<?php
								$display_txt = $news['content'];
								
								echo str_replace("\n","<br />",$display_txt);
								
							?>
							
								
						</div>
					</div>
      			</div>
			
      			    
      		</div>
	
        </div>

      </div>
    
	
	 <div class="padding">
		 <h5 class="m-b">Comments</h5>
			    <div class="streamline m-b m-l">
					@foreach($comments as $comment)	
					  <div class="sl-item">
						<div class="sl-left">
						
					
	
						
						  <img src="<?php 
						  
							
							if (strpos($comment->image,"http") !== false) {
								echo $comment->image;
							}
							else         echo asset($comment->image);
						  
						  ?>" class="img-circle">
						
						  
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
			  
	</div>
	
	<?php
	if (Auth::check()){
	?>	
	<div class = "padding">
		 <div class="box m-a-0 b-a">
			<form>
			  <textarea class="form-control no-border publish-comment-form" rows="3" placeholder="Type something..."></textarea>
			</form>
			<div class="box-footer clearfix">
			  <button data-post-id = "<?php echo $news->id; ?>" class="btn btn-info pull-right btn-sm publish-comment" data-post-type = '0'>Post</button>
			  
			   
			  <ul class="nav nav-pills nav-sm">
				<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-camera text-muted"></i></a></li>
				<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-video-camera text-muted"></i></a></li>
			  </ul>
			</div>
		  </div>
	</div>
	
	
	<?php
		}
	?>
	</div>
	
	
	@include('like')
	
  </div>
  
</div>

<!-- ############ PAGE END-->

</div>
 
@stop