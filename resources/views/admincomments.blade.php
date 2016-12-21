
@extends('adminmenu')
@section('admin_content')
<div class="col-md-10">
	<div class="content-box-large">
	<div class="panel-heading">
	  <div class="panel-title">Comments<br>
		<br>
	<!--	Sort By : Publish | Unpublished&nbsp; | Trash -->
	
	</div>
	</div>
	<div class="panel-body">
	  <table class="table table-striped table-bordered" id="example" border="0"
		cellpadding="0"
		cellspacing="0">
		<thead>
		  <tr>
			<th>No</th>
			<th>Title</th>
			<th>comment</th>
			<th>Status</th>
			<th>Action</th>
		  </tr>
		</thead>
		<tbody>
		<?php  $i = 0; ?>	
		 @foreach($comments as $comment)	
		 
		  <tr class="odd gradeX">
			<td><?php  echo ++$i; ?></td>
			<td>{{$comment->title}}</td>
			<td>{{$comment->content}}</td>
			<td>
				
				@if($comment->status == 0)
					Unpublished
				@else
					Published
				@endif
				
			</td>
			<td>
			
				@if($comment->status == 0)
					<button class="btn btn-primary btn-xs admin-publish-comment" data-id = "{{$comment->id}}" data-user-id = "{{$comment->user_id}}" >Publish</button>
				@else
					<button class="btn btn-primary btn-xs admin-unpublish-comment" data-id = "{{$comment->id}}" data-user-id = "{{$comment->user_id}}">Unpublish</button>
				@endif
				
				
					<a href = "/deletecomment/{{$comment->id}}" class="btn btn-danger btn-xs admin-trash-song">Trash</a>
			
			
			</td>
		  </tr>
		  
		   @endforeach
		</tbody>
	  </table>
	</div>
	</div>
</div>
@stop