<?php

	function find_favorite($favorite_songsbyuser, $song_id){
		foreach($favorite_songsbyuser as $fav_item){
			
			if($song_id == $fav_item['song_id'])
				return 1;
			
		}
		return 0;
	}
	
	
	/*
	
	<?php  		
		if(Auth::check()){
			$ret_val = find_favorite($favorite_songsbyuser, $featuredsong->id);
			if($ret_val) echo 'is-like';
		}
		
		
	?>
				
	
	
	*/
	
	
?>