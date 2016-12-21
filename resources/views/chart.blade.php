
@extends('menu')
@section('main_content')

@if(Auth::check())
	@include('function')
@endif


  <div class="app-body" id="view">

<!-- ############ PAGE START-->

<div class="page-content">
  <div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
      <div class="padding">        
        <div class="page-title m-b">
          <h1 class="inline m-a-0">Charts</h1>
          <div class="dropdown inline">
            <button class="btn btn-sm no-bg h4 m-y-0 v-b dropdown-toggle text-primary" data-toggle="dropdown">
				<?php
					if(isset($_REQUEST['sort'])){
						echo strtoupper($_REQUEST['sort']);
					}
					else echo 'All the time';
				?>
				
			</button>
            <div class="dropdown-menu">
              <a href="/chart?sort=week" class="dropdown-item active">
                Last week
              </a>
              <a href="/chart?sort=month" class="dropdown-item">
                Last month
              </a>
              <a href="/chart?sort=year" class="dropdown-item">
                Last year
              </a>
              <a href="/chart" class="dropdown-item">
                All the time
              </a>
            </div>
          </div>
        </div>
        <div class="row item-list item-list-md item-list-li m-b">
            <div class="col-xs-12">
			
				
				@foreach($chartsongs as $song)

				<div class="item r" data-id="{{$song->id}}" data-src="server/php/files/{{$song->source}}">
				
          			<div class="item-media ">
          				
						 <a href="/trackdetail/<?php
									$display_txt = $song->title;
									echo str_slug($display_txt, '-');
						 
						 ?>/{{$song->id}}" class="item-media-content" style="background-image: url('<?php echo asset('server/php/files/'.$song->image) ?>')"></a>
						
          				<div class="item-overlay center">
          					<button  class="btn-playpause">Play</button>
          				</div>
          			</div>
          			<div class="item-info">
          				<div class="item-overlay bottom text-right">
          					<a href="#" class="btn-favorite <?php  		
								if(Auth::check()){
									$ret_val = find_favorite($favorite_songsbyuser, $song->id);
									if($ret_val) echo 'is-like';
								}
		
		
	?>"><i class="fa fa-heart-o"></i></a>
          					<a href="#" class="btn-more" data-toggle="dropdown"  data-downloadsrc = "server/php/files/{{$song->source}}" data-id="{{$song->id}}"  ><i class="fa fa-ellipsis-h"></i></a>
          					<div class="dropdown-menu pull-right black lt"></div>
          				</div>
          				<div class="item-title text-ellipsis">
          					<a href="/trackdetail/<?php  
								
									$display_txt = $song->title;
									echo str_slug($display_txt, '-');
							
							?>/{{$song->id}}">{{$song->title}}</a>
          				</div>
          				<div class="item-author text-sm text-ellipsis ">
          					<a href="/artistdetail/<?php  

									$display_txt = $song->name;
									echo str_slug($display_txt, '-');
								
							?>/{{$song->artise_id}}" class="text-muted">{{$song->name}}</a>
          				</div>
          				<div class="item-meta text-sm text-muted">
          		          <span class="item-meta-stats text-xs  item-meta-right">
          		          	<i class="fa fa-play text-muted"></i> {{$song->downloaded}}
          		          	<i class="fa fa-heart m-l-sm text-muted"></i> {{$song->loved}}
          		          </span>
          		        </div>
          
          
          			</div>
          		</div>
				
				@endforeach
				
          	</div>
            </div>

      </div>
    </div>
    
	
	@include('like')

 </div>
</div>

<!-- ############ PAGE END-->

    </div>
  
@stop