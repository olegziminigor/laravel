
@extends('menu')
@section('main_content')
  <!-- content -->
  <div class="app-body" id="view">
	<!-- ############ PAGE START-->
	<div class="page-content">
		<div class="row-col">
		 <div class="col-lg-9 b-r no-border-md">
      <div class="padding">
        

        <div class="page-title m-b">
          <h1 class="inline m-a-0">Lyrics</h1>
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
              <a href="{{ url('/lyrics/') }}" class="dropdown-item active" data-crt = "">
                All
              </a>
              <a href="{{ url('/lyrics?sort=a') }}" class="dropdown-item" data-crt = "A">A </a>
              <a href="{{ url('/lyrics?sort=b') }}" class="dropdown-item" data-crt = "B">B</a>
              <a href="{{ url('/lyrics?sort=c') }}" class="dropdown-item" data-crt = "C">C</a>
			  
			  <a href="{{ url('/lyrics?sort=d') }}" class="dropdown-item" data-crt = "D">D</a>
			  <a href="{{ url('/lyrics?sort=e') }}" class="dropdown-item" data-crt = "E">E</a>
			  <a href="{{ url('/lyrics?sort=f') }}" class="dropdown-item" data-crt = "F">F</a>
			  <a href="{{ url('/lyrics?sort=g') }}" class="dropdown-item" data-crt = "G">G</a>
			  <a href="{{ url('/lyrics?sort=h') }}" class="dropdown-item" data-crt = "H">H </a>
			  <a href="{{ url('/lyrics?sort=i') }}" class="dropdown-item" data-crt = "I">I </a>
			  <a href="{{ url('/lyrics?sort=j') }}" class="dropdown-item" data-crt = "J">J</a>
			  <a href="{{ url('/lyrics?sort=k') }}" class="dropdown-item" data-crt = "K">K</a>
			  <a href="{{ url('/lyrics?sort=l') }}" class="dropdown-item" data-crt = "L">L</a>
			  <a href="{{ url('/lyrics?sort=m') }}" class="dropdown-item" data-crt = "M">M</a>
			  <a href="{{ url('/lyrics?sort=n') }}" class="dropdown-item" data-crt = "N">N</a>
			  <a href="{{ url('/lyrics?sort=o') }}" class="dropdown-item" data-crt = "O">O</a>
			  <a href="{{ url('/lyrics?sort=p') }}" class="dropdown-item" data-crt = "P">P</a>
			  <a href="{{ url('/lyrics?sort=q') }}" class="dropdown-item" data-crt = "Q">Q</a>
			  <a href="{{ url('/lyrics?sort=r') }}" class="dropdown-item" data-crt = "R">R</a>
			  <a href="{{ url('/lyrics?sort=s') }}" class="dropdown-item" data-crt = "S">S</a>
			  <a href="{{ url('/lyrics?sort=t') }}" class="dropdown-item" data-crt = "T">T</a>
			  <a href="{{ url('/lyrics?sort=u') }}" class="dropdown-item" data-crt = "U">U</a>
			  <a href="{{ url('/lyrics?sort=v') }}" class="dropdown-item" data-crt = "V">V</a>
			  <a href="{{ url('/lyrics?sort=w') }}" class="dropdown-item" data-crt = "W">W</a>
			  <a href="{{ url('/lyrics?sort=x') }}" class="dropdown-item" data-crt = "X">X</a>
			  <a href="{{ url('/lyrics?sort=y') }}" class="dropdown-item" data-crt = "Y">Y</a>
			  <a href="{{ url('/lyrics?sort=z') }}" class="dropdown-item" data-crt = "Z">Z</a>
			  
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
			
			@foreach($lyrics as $lyric)
				<div class="col-xs-4 col-sm-4 col-md-3">
					<div class="item r" data-id="{{$lyric->id}}">
						<div class="item-media">
							<a href="/lyric-detail/<?php  
									$display_txt = $lyric->title;
									echo str_slug($display_txt, '-');
							?>/{{$lyric->id}}" class="item-media-content" style="background-image: url('<?php echo asset('server/php/files/'.$lyric->image) ?>');"></a>
							
							
							
						</div>
						<div class="item-info">
							
							<div class="item-title text-ellipsis">
								<a href="/lyric-detail/<?php  
									$display_txt = $lyric->title;
									echo str_slug($display_txt, '-');
								?>/{{$lyric->id}}">{{$lyric->title}}</a>
							</div>
							<div class="item-author text-sm text-ellipsis ">
								
								
								<a href="/artistdetail/<?php 
									$display_txt = $lyric->name;
									echo str_slug($display_txt, '-');
								
								?>/{{$lyric->artise_id}}"" class="text-muted">{{$lyric->name}}</a>
						
						
						
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


  
