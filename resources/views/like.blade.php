	
    <div class="col-lg-3 w-xxl w-auto-md">
      <div class="padding" style="bottom: 60px;" data-ui-jp="stick_in_parent">
      	<h6 class="text text-muted">5 Most Liked Songs</h6>
      	<div class="row item-list item-list-sm m-b">
		
			@foreach($likesongs as $likesong)
      		    <div class="col-xs-12">
					<div class="item r" data-id="{{$likesong->id}}" data-src="{{$likesong->source}}">	
      					<div class="item-media ">
      						
							<a href="/trackdetail/<?php 
							$display_txt = $likesong->title;
							echo str_replace(" ","-",$display_txt);
						?>/{{$likesong->id}}" class="item-media-content" style="background-image: url('<?php 
								echo asset('server/php/files/'.$likesong->image);
						?>');"></a>
						
						
				
						
						
      					</div>
      					<div class="item-info">
      						<div class="item-title text-ellipsis">

								<a href="/trackdetail/<?php 
								$display_txt = $likesong->title;
								echo str_replace(" ","-",$display_txt);
							
							?>/{{$likesong->id}}">{{$likesong->title}}</a>
							
							
      						</div>
      						<div class="item-author text-sm text-ellipsis ">
								<a href="/artistdetail/<?php  

									$display_txt = $likesong->artist->name;
									echo str_replace(" ","-",$display_txt);
								
							?>/{{$likesong->artise_id}}" class="text-muted">{{$likesong->artist->name}}</a>
      						</div>
      		
      		
      					</div>
      				</div>
      			</div>
				
			@endforeach
			
      	</div>

          <div class="nav text-sm _600">
          	<!--<a href="#" class="nav-link text-muted m-r-xs">About</a>
          	<a href="#" class="nav-link text-muted m-r-xs">Contact</a>
          	<a href="#" class="nav-link text-muted m-r-xs">Legal</a>
          	<a href="#" class="nav-link text-muted m-r-xs">Policy</a>-->
          	<p> Your Donation Will Help Us Keep The Site On </p>
          	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="hosted_button_id" value="BZW6KALEE463S" />
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate" />
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
</form>
          </div>
          <p class="text-muted text-xs p-b-lg">&copy; Copyright 2016 - 2017</p>

      </div>
    </div>
 
  