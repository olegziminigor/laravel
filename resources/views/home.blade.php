@extends('menu')
@section('main_content')

@if(Auth::check())
	@include('function')
@endif

 <div class="app-body" id="view">

<!-- ############ PAGE START-->


<div class="page-content">

  <div class="black dk">
    <div class="row no-gutter item-info-overlay">
      <div class="col-sm-6 text-white">
        <div class="owl-carousel owl-theme owl-dots-sm owl-dots-bottom-left " data-ui-jp="owlCarousel" data-ui-options="{
                     items: 1
                    ,loop: true
                    ,autoplay: true
                    ,nav: true
                    
                  }">

		<?php 
			$count_item = 0; 
		?>
		@foreach($featuredsongs as $featuredsong)
		<?php 
			$count_item++;
		?>

          <div class="item r" data-id="{{$featuredsong->id}}" data-src="server/php/files/{{$featuredsong->source}}">
            <div class="item-media primary">
              <a href="/trackdetail" class="item-media-content" style="background-image: url('server/php/files/{{$featuredsong->image}}');" ></a>
              <div class="item-overlay center">
                <button class="btn-playpause">Play</button>
              </div>
            </div>
            <div class="item-info">
              <div class="item-overlay bottom text-right">
                <a href="#" class="btn-favorite <?php  
					
					if(Auth::check()){
						$ret_val = find_favorite($favorite_songsbyuser, $featuredsong->id);
						if($ret_val) echo 'is-like';
					}
					
					
				?>"><i class="fa fa-heart-o"></i></a>
                <a href="#" class="btn-more" data-toggle="dropdown"  data-downloadsrc = "server/php/files/{{$featuredsong->source}}" data-id="{{$featuredsong->id}}"><i class="fa fa-ellipsis-h"></i></a>
                <div class="dropdown-menu pull-right black lt"></div>
              </div>
              <div class="item-title text-ellipsis">
                <a href="/trackdetail/{{str_slug($featuredsong->title, '-')}}/{{$featuredsong->id}}">{{ $featuredsong->title }}</a>
              </div>
              <div class="item-author text-sm text-ellipsis">
                <a href="/artistdetail/{{str_slug($featuredsong->name, '-')}}/<?php echo $featuredsong['artise_id'] ?>"" class="text-muted"><?php echo $featuredsong['artist']['name'] ?></a>
              </div>
            </div>
          </div>
		<?php  if($count_item == 3) break; ?>
		@endforeach
		</div>
      </div>
         
		
		 
	<?php 
		for($i = $count_item; $i< $count; $i++){
		
    ?>
		<div class="col-sm-3 col-xs-6">
          	<div class="item r" data-id="<?php echo $featuredsongs[$i]['id'] ?>" data-src="server/php/files/<?php echo $featuredsongs[$i]['source']; ?>">
      			<div class="item-media ">
      				<a href="/trackdetail/<?php 
							$display_txt = $featuredsongs[$i]['title'];
							echo str_slug($display_txt, '-');
						
						?>/<?php echo $featuredsongs[$i]['id'] ?>" class="item-media-content" style="background-image: url('server/php/files/<?php echo $featuredsongs[$i]['image'] ?>');"></a>
					
					
					
      				<div class="item-overlay center">
      					<button  class="btn-playpause">Play</button>
      				</div>
      			</div>
      			<div class="item-info">
      				<div class="item-overlay bottom text-right">
      					<a href="#" class="btn-favorite  <?php  		
							if(Auth::check()){
								$ret_val = find_favorite($favorite_songsbyuser, $featuredsongs[$i]['id']);
								if($ret_val) echo 'is-like';
							}
		
		
	?>"><i class="fa fa-heart-o"></i></a>
      					<a href="#" class="btn-more" data-toggle="dropdown"  data-downloadsrc = "server/php/files/<?php echo $featuredsongs[$i]['source']; ?>" data-id="<?php echo $featuredsongs[$i]['id'] ?>" ><i class="fa fa-ellipsis-h"></i></a>
      					<div class="dropdown-menu pull-right black lt"></div>
      				</div>
      				<div class="item-title text-ellipsis">
      					<a href="/trackdetail/<?php 
							$display_txt = $featuredsongs[$i]['title'];
							echo str_slug($display_txt, '-');
						
						?>/<?php echo $featuredsongs[$i]['id'] ?>"><?php echo $featuredsongs[$i]['title']  ?></a>
      				</div>
      				<div class="item-author text-sm text-ellipsis ">
      					<a href="/artistdetail/<?php 
							$display_txt = $featuredsongs[$i]['artist']['name'];
							echo str_slug($display_txt, '-');
						
						?>/<?php echo $featuredsongs[$i]['artise_id'] ?>" class="text-muted"><?php echo $featuredsongs[$i]['artist']['name'] ?></a>
      				</div>
      
      
      			</div>
      		</div>
      	  </div>
	<?php   
		}
	?>

	</div>
  </div>
  
   
  
  <div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
      <div class="padding">
        <h2 class="widget-title h4 m-b">Trending</h2>
        <div class="owl-carousel owl-theme owl-dots-center" data-ui-jp="owlCarousel" data-ui-options="{
          margin: 20,
          responsiveClass:true,
          responsive:{
            0:{
              items: 2
            },
              543:{
                  items: 3
              }
          }
        }">
			
			@foreach($treadsongs as $treadsong)
              <div class="">
				<div class="item r" data-id="{{$treadsong->id}}" data-src="server/php/files/{{$treadsong->source}}">
          			<div class="item-media item-media-4by3">
						<a href="/trackdetail/<?php 
							$display_txt = $treadsong->title;
							echo str_slug($display_txt, '-');
						
						?>/{{$treadsong->id}}" class="item-media-content" style="background-image: url('server/php/files/{{$treadsong->image}}');"></a>

          				<div class="item-overlay center">
          					<button  class="btn-playpause">Play</button>
          				</div>
          			</div>
          			<div class="item-info">
          				<div class="item-overlay bottom text-right">
          					<a href="#" class="btn-favorite  <?php  		
								if(Auth::check()){
									$ret_val = find_favorite($favorite_songsbyuser, $treadsong->id);
									if($ret_val) echo 'is-like';
								}
		
		
	?>"><i class="fa fa-heart-o"></i></a>
          					<a href="#" class="btn-more" data-toggle="dropdown" data-downloadsrc = "server/php/files/<?php echo $treadsong['source']; ?>" data-id="<?php echo $treadsong['id'] ?>"><i class="fa fa-ellipsis-h"></i></a>
          					<div class="dropdown-menu pull-right black lt"></div>
          				</div>
          				<div class="item-title text-ellipsis">
          					<a href="/trackdetail/<?php 
							$display_txt = $treadsong->title;
							echo str_slug($display_txt, '-');
						
						?>/{{$treadsong->id}}">{{$treadsong->title}}</a>
          				</div>
          				<div class="item-author text-sm text-ellipsis ">
          					<a href="/artistdetail/<?php  

									$display_txt = $treadsong->artist->name;
									echo str_slug($display_txt, '-');
								
							?>/{{$treadsong->artise_id}}" class="text-muted">
								{{$treadsong->artist->name}}
							</a>
          				</div>
          
          
          			</div>
          		</div>
          	</div>
            @endforeach

		</div>
		
		 
        <h2 class="widget-title h4 m-b">New</h2>
        <div class="row">
			@foreach($newsongs as $newsong)
                <div class="col-xs-4 col-sm-4 col-md-3">

				<div class="item r" data-id="{{$newsong->id}}" data-src="server/php/files/{{$newsong->source}}">	
          			<div class="item-media ">
						<a href="/trackdetail/<?php 
							$display_txt = $newsong->title;
							echo str_slug($display_txt, '-');
						
						?>/{{$newsong->id}}" class="item-media-content" style="background-image: url('server/php/files/{{$newsong->image}}');"></a>

          				<div class="item-overlay center">
          					<button  class="btn-playpause">Play</button>
          				</div>
          			</div>
          			<div class="item-info">
          				<div class="item-overlay bottom text-right">
          					<a href="#" class="btn-favorite <?php  		
									if(Auth::check()){
										$ret_val = find_favorite($favorite_songsbyuser, $newsong->id);
										if($ret_val) echo 'is-like';
									}
		
		
	?>"><i class="fa fa-heart-o"></i></a>
          					<a href="#" class="btn-more" data-toggle="dropdown" data-downloadsrc = "server/php/files/{{$newsong->source}}" data-id="{{$newsong->id}}"><i class="fa fa-ellipsis-h"></i></a>
          					<div class="dropdown-menu pull-right black lt"></div>
          				</div>
          				<div class="item-title text-ellipsis">
          					<a href="/trackdetail/<?php 
							$display_txt = $newsong->title;
							echo str_slug($display_txt, '-');
						
						?>/{{$newsong->id}}">{{$newsong->title}}</a>
          				</div>
          				<div class="item-author text-sm text-ellipsis ">
          					<a href="/artistdetail/<?php  

									$display_txt = $newsong->artist->name;
									echo str_slug($display_txt, '-');
								
							?>/{{$newsong->artise_id}}" class="text-muted">{{$newsong->artist->name}}</a>
          				</div>
          
          
          			</div>
          		</div>
         

			   </div>
			@endforeach
	
        </div>
      
		<h2 class="widget-title h4 m-b">Recent Lyrics and Recent News</h2>
        <div class="row item-list item-list-md m-b">
		
			@foreach($newlyrics as $recommendsong)
			
            <div class="col-sm-6">
				<div class="item r">	
				
          			<div class="item-media ">
						<a href="/lyric-detail/<?php 
							$display_txt = $recommendsong->title;
							echo str_slug($display_txt, '-');
						?>/{{$recommendsong->id}}" class="item-media-content" style="background-image: url('server/php/files/{{$recommendsong->image}}');"></a>
						
					
							
          				
          			</div>
          			<div class="item-info">
          				
          				<div class="item-title text-ellipsis">
							<a href="/lyric-detail/<?php 
								$display_txt = $recommendsong->title;
								echo str_slug($display_txt, '-');
							
							?>/{{$recommendsong->id}}">{{$recommendsong->title}}</a>
          				</div>
						
          			</div>
          		</div>
          	</div>
			
			@endforeach
			
			
			@foreach($newnews as $recommendsong)
			
            <div class="col-sm-6">
				<div class="item r">	
				
          			<div class="item-media ">
						<a href="/full-post/<?php 
							$display_txt = $recommendsong->title;
							echo str_slug($display_txt, '-');
						?>/{{$recommendsong->id}}" class="item-media-content" style="background-image: url('server/php/files/{{$recommendsong->image}}');"></a>
						
          				
          			</div>
          			<div class="item-info">
          				
          				<div class="item-title text-ellipsis">
							<a href="/full-post/<?php 
								$display_txt = $recommendsong->title;
								echo str_slug($display_txt, '-');
							
							?>/{{$recommendsong->id}}">{{$recommendsong->title}}</a>
          				</div>
						
          			</div>
          		</div>
          	</div>
			
			@endforeach
			
			
			
			
        </div>
      </div>
    </div>
	
	  
	
    @include('like')

 </div>
</div>

<!-- ############ PAGE END-->

    </div>

@endsection
