@extends('adminmenu')
@section('admin_content')
<div class="col-md-10">		
	<div class="row-col">
        <div class="p-a-lg h-v row-cell">
          <div class="row">
			
			<div class = "col-md-12 modal-title"> 
				<h3 class="display-5" >Add and Edit News</h3>
			</div>
			
            <div class="col-md-8 offset-md-2 v-m">
					<div class="tab-pane" id="profile">

					<?php
						if(isset($news))
							$url = "/uploadnews?id=".$news['id'];
						else
							$url = "/uploadnews";
					?>
						<form role = "form" method = "POST" action="<?php echo $url ?>">
							<div class="form-group row">
								<div class="col-sm-3 form-control-label text-muted">News Title</div>
								<div class="col-sm-9"><input id = "title_upload_news" name = "title_upload_news" value="<?php if(isset($news)) echo $news['title'] ?>" class="form-control"></div>
							</div>
							<div class="form-group row">
							  <div class="col-sm-3 form-control-label text-muted">News Content</div>
							  <div class="col-sm-9">
								<textarea id = "news_upload_content" name = "news_upload_content" class="form-control" rows="5"><?php if(isset($news)) echo $news['content'] ?></textarea>
							  </div>
							</div>
				
						  <div class="form-group row">
							<div class="col-sm-3 form-control-label text-muted">Upload Images (optional)</div>
							<div class="col-sm-9">
								
							    <span class="btn btn-success fileinput-button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Add files...</span>
									<!-- The file input field used as target for the file upload widget -->
									<input id="fileupload_news" type="file" name="files" multiple>
								</span>
								
								<br>
								<br>
								<!-- The global progress bar -->
								<div id="progress_image_news" class="progress">
									<div class="progress-bar progress-bar-success"></div>
								</div>
								<!-- The container for the uploaded files -->
								<div id="files_upload_news" class="files">

									<?php if(isset($news)){
									?>	
										<div>
											<p>											
											<img src = "server/php/files/{{$news->image}}" height = "100" width = '100' />
												<br>
												<span><?php echo $news['image'] ?></span>
											</p>
										</div>
									<?php	
									} ?>
								
								</div>
								<br>
								
							</div>
						  </div>
						<?php
						echo '<input id = "hidden_token" type = "hidden" value = "'. csrf_token().'" name = "_token">';

						?>	
						  
						  <input type = "hidden" id = "uploadnews_img"  name = "uploadnews_img" value = "<?php if(isset($news)) echo $news['image'] ?>" />
						
						<div style = "text-align:center">
						  <button id = "uploadnews_save" type="submit" class="btn btn-success btn-lg" >		SAVE
						  </button> 
						</div> 
						  
						</form>
					</div>
				
			</div>
          </div>
        </div>
      </div>
</div>
@stop