
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
          <h1 class="inline m-a-0">Browse</h1>
          <div class="dropdown inline">
            <button class="btn btn-sm no-bg h4 m-y-0 v-b dropdown-toggle text-primary" data-toggle="dropdown">
				<?php
					if(isset($_REQUEST['sort'])){
						echo strtoupper($_REQUEST['sort']);
					}
					else echo 'ALL';
				?>
			</button>
            <div class="dropdown-menu">
              <a href="{{ url('/browse/') }}" class="dropdown-item active" data-crt = "">
                All
              </a>
              <a href="{{ url('/browse?sort=a') }}" class="dropdown-item" data-crt = "A">A </a>
              <a href="{{ url('/browse?sort=b') }}" class="dropdown-item" data-crt = "B">B</a>
              <a href="{{ url('/browse?sort=c') }}" class="dropdown-item" data-crt = "C">C</a>
			  <a href="{{ url('/browse?sort=d') }}" class="dropdown-item" data-crt = "D">D</a>
			  <a href="{{ url('/browse?sort=e') }}" class="dropdown-item" data-crt = "E">E</a>
			  <a href="{{ url('/browse?sort=f') }}" class="dropdown-item" data-crt = "F">F</a>
			  <a href="{{ url('/browse?sort=g') }}" class="dropdown-item" data-crt = "G">G</a>
			  <a href="{{ url('/browse?sort=h') }}" class="dropdown-item" data-crt = "H">H </a>
			  <a href="{{ url('/browse?sort=i') }}" class="dropdown-item" data-crt = "I">I </a>
			  <a href="{{ url('/browse?sort=j') }}" class="dropdown-item" data-crt = "J">J</a>
			  <a href="{{ url('/browse?sort=k') }}" class="dropdown-item" data-crt = "K">K</a>
			  <a href="{{ url('/browse?sort=l') }}" class="dropdown-item" data-crt = "L">L</a>
			  <a href="{{ url('/browse?sort=m') }}" class="dropdown-item" data-crt = "M">M</a>
			  <a href="{{ url('/browse?sort=n') }}" class="dropdown-item" data-crt = "N">N</a>
			  <a href="{{ url('/browse?sort=o') }}" class="dropdown-item" data-crt = "O">O</a>
			  <a href="{{ url('/browse?sort=p') }}" class="dropdown-item" data-crt = "P">P</a>
			  <a href="{{ url('/browse?sort=q') }}" class="dropdown-item" data-crt = "Q">Q</a>
			  <a href="{{ url('/browse?sort=r') }}" class="dropdown-item" data-crt = "R">R</a>
			  <a href="{{ url('/browse?sort=s') }}" class="dropdown-item" data-crt = "S">S</a>
			  <a href="{{ url('/browse?sort=t') }}" class="dropdown-item" data-crt = "T">T</a>
			  <a href="{{ url('/browse?sort=u') }}" class="dropdown-item" data-crt = "U">U</a>
			  <a href="{{ url('/browse?sort=v') }}" class="dropdown-item" data-crt = "V">V</a>
			  <a href="{{ url('/browse?sort=w') }}" class="dropdown-item" data-crt = "W">W</a>
			  <a href="{{ url('/browse?sort=x') }}" class="dropdown-item" data-crt = "X">X</a>
			  <a href="{{ url('/browse?sort=y') }}" class="dropdown-item" data-crt = "Y">Y</a>
			  <a href="{{ url('/browse?sort=z') }}" class="dropdown-item" data-crt = "Z">Z</a>
			  
			  
			  
            </div>
          </div>
        </div>
        <div data-ui-jp="jscroll" class="jscroll-loading-center" data-ui-options="{
            autoTrigger: true,
            loadingHtml: '<i class=\'fa fa-refresh fa-spin text-md text-muted\'></i>',
            padding: 50,
            nextSelector: 'a.jscroll-next:last'
          }">
      		<div class="row">
			
			@foreach($songs as $song)
				<div class="col-xs-4 col-sm-4 col-md-3">
					<div class="item r" data-id="{{$song->id}}" data-src="<?php echo asset('server/php/files/'.$song->source) ?>" >
						<div class="item-media ">
							<a href="/trackdetail/<?php 
							$display_txt = $song->title;
							echo str_slug($display_txt, '-');
						
						?>/{{$song->id}}" class="item-media-content" style="background-image: url('server/php/files/{{$song->image}}');"></a>
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
									
								<a href="#" class="btn-more" data-toggle="dropdown"  data-downloadsrc = "server/php/files/{{$song->source}}" data-id="{{$song->id}}"><i class="fa fa-ellipsis-h"></i></a>
								<div class="dropdown-menu pull-right black lt play-item"></div>
							</div>
							<div class="item-title text-ellipsis">
								<a href="/trackdetail/<?php 
							$display_txt = $song->title;
							echo str_slug($display_txt, '-');
						
						?>/{{$song->id}}">{{$song->title}}</a>
							</div>
							<div class="item-author text-sm text-ellipsis ">
								<a href="artistdetail/<?php 
							$display_txt = $song->name;
							echo str_slug($display_txt, '-');
						
						?>/{{$song->artise_id}}" class="text-muted">{{$song->name}}</a>
							</div>      			
			
						</div>
					</div>
      			</div>
			@endforeach
      			    
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
    </div>
	
	
	 @include('like')

 </div>
  
</div>

<!-- ############ PAGE END-->

</div>
 
@stop