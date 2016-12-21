@extends('adminmenu')
@section('admin_content')
 <div class="col-md-10">
          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">Music List<br>
                <br>
                <!--Sort By : Publish | Unpublished | Feature | Trash !-->
				
				
				</div>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered" id="example" border="0"
                cellpadding="0"
                cellspacing="0">
                <thead>
                  <tr>
					<th>No</th>
                    <th>Song Title</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php  $i = 0; ?>
				 @foreach($songs as $song)
                  <tr class="odd gradeX">
					<td><?php  echo ++$i; ?></td>
                    <td>{{$song->title}}</td>
                    <td class = "status">
						@if($song->status == 0)
							Unpublished
						@else
							Published
						@endif
					</td>
                    <td>
						@if($song->status == 0)
							<button class="btn btn-primary btn-xs admin-publish-song" data-id = "{{$song->id}}" data-user-id = "{{$song->artise_id}}">Publish</button>
						@else
							<button class="btn btn-primary btn-xs admin-unpublish-song" data-id = "{{$song->id}}" data-user-id = "{{$song->artise_id}}">Unpublish</button>
						@endif
						
						
						<a href = "/deletesong/{{$song->id}}" class="btn btn-danger btn-xs admin-trash-song" data-id = "{{$song->id}}" data-user-id = "{{$song->artise_id}}">Trash</a>
						
		

						@if($song->featured == 0)
						
							@if($count == 1)
						<button class="btn btn-success btn-xs admin-feature-song disabled" data-id = "{{$song->id}}" data-user-id = "{{$song->artise_id}}">Set Feature</button>
							@else
						<button class="btn btn-success btn-xs admin-feature-song" data-id = "{{$song->id}}" data-user-id = "{{$song->artise_id}}">Set Feature</button>
							@endif

						@else

							@if($count == 1)
						<button class="btn btn-success btn-xs admin-unfeature-song" data-id = "{{$song->id}}" data-user-id = "{{$song->artise_id}}">Unset Feature</button>
							@else
						<button class="btn btn-success btn-xs admin-unfeature-song" data-id = "{{$song->id}}" data-user-id = "{{$song->artise_id}}">Unset Feature</button>
							@endif
						@endif
						
					</td>
				  </tr>
				   @endforeach
				  
                </tbody>
              </table>
            </div>
          </div>
</div>
@stop     