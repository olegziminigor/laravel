
@extends('menu')
@section('main_content')

@if(Auth::check())
	@include('function')
@endif

<div class="app-body" id="view">
<!-- ############ PAGE START-->
<div class="pos-rlt">

		@if($artist->image)
		<div class="page-bg" data-stellar-ratio="2" style="background-image: url('<?php 

				
				if (strpos($artist->image,"http") !== false) {
					echo $artist->image;
				}
					else    echo asset($artist->image);
							
	
			?>');"></div>
		@else
		<div class="page-bg" data-stellar-ratio="2" style="background-image: url('images/no_image.jpg');"></div>
		@endif
  

</div>
<div class="page-content">
  <div class="padding b-b">
    <div class="row-col">
        <div class="col-sm w w-auto-xs m-b">
          <div class="item w rounded">
            <div class="item-media">
			
			@if($artist->image)
		<div class="item-media-content"  style="background-image: url('<?php 
	
				
				if (strpos($artist->image,"http") !== false) {
					echo $artist->image;
				}
					else    echo asset($artist->image);
							
	
			?>');"></div>
		@else
		<div class="item-media-content" style="background-image: url('images/no_image.jpg');"></div>
		@endif
		
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="p-l-md no-padding-xs">
            <div class="page-title">
              <h1 class="inline">{{$artist->name}}</h1>
              <label class="fa fa-star text-primary text-lg m-b v-m m-l-xs" title="Pro"></label>
            </div>
            <p class="item-desc text-ellipsis text-muted" data-ui-toggle-class="text-ellipsis">
		
			
			<?php
								$display_txt = $artist->BIO;
								
								echo str_replace("\n","<br />",$display_txt);
								
			?>
			
			</p>
            <div class="item-action m-b">
              <span><?php echo count($user_songs);  ?> Tracks</span>
            </div>
          @include('share')
          </div>
        </div>
    </div>
  </div>

			  
  <div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
      <div class="padding">
        <div class="nav-active-border b-primary bottom m-b-md">
          <ul class="nav l-h-2x">
           
            <li class="nav-item m-r inline">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_2">Tracks</a>
            </li>
          
            <li class="nav-item m-r inline">
              <a class="nav-link active" href="#" data-toggle="tab" data-target="#tab_4">Profile</a>
            </li>
          </ul>
        </div>
        <div class="tab-content">
       <div class="tab-pane" id="tab_2">
            <div class="row m-b">
			
				@foreach($user_songs as $song_item)
					
                  <div class="col-xs-4 col-sm-4 col-md-3">
                  	
					
					<div class="item r" data-id="{{$song_item->id}}" data-src="<?php echo asset('server/php/files/'.$song_item['source']) ?>">
					
              			<div class="item-media ">
						
						
							 <a href="/trackdetail/{{str_slug($song_item->title, '-')}}/{{$song_item->id}}" class="item-media-content" style="background-image: url('<?php echo asset('server/php/files/'.$song_item['image']) ?>')"></a>
							
							<div class="item-overlay center">
              					<button  class="btn-playpause">Play</button>
              				</div>
              			</div>
              			<div class="item-info">
              				<div class="item-overlay bottom text-right">
              					<a href="#" class="btn-favorite <?php  
					
					if(Auth::check()){
						$ret_val = find_favorite($favorite_songsbyuser, $song_item->id);
						if($ret_val) echo 'is-like';
					}
					
					
				?>"><i class="fa fa-heart-o"></i></a>
              					<a href="#" class="btn-more" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
              					<div class="dropdown-menu pull-right black lt"></div>
              				</div>
              				<div class="item-title text-ellipsis">
								<a href="/trackdetail/{{str_slug($song_item->title, '-')}}/{{$song_item->id}}" >{{$song_item->title}}</a>
              				</div>
              				
              				<div class="item-meta text-sm text-muted">
              		          <span class="item-meta-stats text-xs ">
              		          	<i class="fa fa-heart m-l-sm text-muted"></i>  <?php echo $song_item->fav_count; ?>
								
              		          </span>
              		        </div>
              
              
              			</div>
              		</div>
              	</div>
				
				@endforeach
				
				
            </div>
            <a href="#" class="btn btn-sm white rounded">Show More</a>
          </div>
        
          <div class="tab-pane active" id="tab_4">
            <div class="row-col m-b">
              <div class="col-xs w-xs text-muted">Country</div>
              <div class="col-xs">{{$artist->country}}</div>
            </div>
			
			    

            <div class="row-col m-b">
              <div class="col-xs w-xs text-muted">Website</div>
              <div class="col-xs">
				@if($artist->website)
				  <a href="{{url($artist->website)}}">
				  {{$artist->website}}</a>
				 @endif
			  </div>
            </div>
			
			
			
			
            <div class="row-col m-b">
              <div class="col-xs w-xs text-muted"></div>
              <div class="col-xs">
				
				@if($artist->fb)
                  <a href="{{$artist->fb}}" class="btn btn-icon btn-social rounded white btn-sm">
                    <i class="fa fa-facebook"></i>
                    <i class="fa fa-facebook indigo"></i>
                  </a>
				@endif
				
				@if($artist->tw)
                  <a href="{{$artist->tw}}" class="btn btn-icon btn-social rounded white btn-sm">
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-twitter light-blue"></i>
                  </a>
                @endif 
				
				@if($artist->ist)
					 <a href="{{$artist->ist}}" class="btn btn-icon btn-social rounded white btn-sm" title="Instagram" >
						<i class="fa fa-instagram"></i>
						<i class="fa fa-instagram light-blue-800"></i>
		
					</a>
				@endif
				 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   
   
	@include('like')
  
  </div>
</div>


</div>



@stop
 
