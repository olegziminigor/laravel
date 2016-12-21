 
@extends('menu')
@section('main_content')
 <div class="app-body" id="view">

	<!-- ############ PAGE START-->
	<div class="padding">
	  <form action="/search_in" class="m-b-md"  method="GET">
		<div class="input-group input-group-lg">
		  <input type="text" class="form-control" placeholder="Type keyword" id ="searchkeyword_in" name = "searchkeyword_in" value = "<?php echo $keyword; ?>">
		  <span class="input-group-btn">
			<button class="btn b-a no-shadow white" type="button">Search</button>
		  </span>
		</div>
		
			{{ csrf_field() }}
			
			
	  </form>
	  <p class="m-b-md"><strong><?php  echo count($songs);  ?></strong> Results found for: <strong>Keyword</strong></p>
	  <div class="m-y">
		<div class="row item-list item-list-lg item-list-by m-b">
		
		@foreach($songs as $song)
			  <div class="col-xs-12">
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
							<a href="#" class="btn-favorite"><i class="fa fa-heart-o"></i></a>
							<a href="#" class="btn-more" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
							<div class="dropdown-menu pull-right black lt"></div>
						</div>
						<div class="item-title text-ellipsis">
							<a href="/trackdetail/<?php 
							$display_txt = $song->title;
							echo str_replace(" ","-",$display_txt);
						
						?>/{{$song->id}}">{{$song->title}}</a>
						</div>
						<div class="item-author text-sm text-ellipsis ">
							<a href="/artistdetail/<?php  

									$display_txt = $song->name;
									echo str_replace(" ","-",$display_txt);
								
							?>/{{$song->artise_id}}" class="text-muted">{{$song->name}}</a>
					
							
							
						</div>
						<div class="item-meta text-sm text-muted">
						  <span class="item-meta-tag visible-list"><a href="browsehtml"></a></span>
						</div>
		  
					</div>
				</div>
			</div>
		@endforeach
		</div>
		
		
		<div style = "display:none">
		  <ul class="pagination">
			<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
			<li class="active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
		  </ul>
		</div>
	  </div>
	</div>

	<!-- ############ PAGE END-->

    </div>

@stop