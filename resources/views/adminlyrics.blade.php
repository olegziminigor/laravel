@extends('adminmenu')
@section('admin_content')
        <div class="col-md-10">
          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">Lyrics List<br>
                <br>
               <!-- Sort By : Publish | Unpublished | Trash  -->
			   
			   </div>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered" id="example" border="0"
                cellpadding="0"
                cellspacing="0">
                <thead>
                  <tr>
					<th> No </th>
                    <th>Song Title</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
				<?php  $i = 0; ?>
				
                <tbody>
				 @foreach($lyrics as $lyric)
                  <tr class="odd gradeX">
					<td><?php  echo ++$i; ?></td>
                    <td>{{$lyric->title}}</td>
                    <td class = "status">
						@if($lyric->status == 0)
							Unpublished
						@else
							Published
						@endif
					</td>
                    <td>							
						@if($lyric->status == 0)
							<button class="btn btn-primary btn-xs admin-publish-lyric" data-id = "{{$lyric->id}}" data-user-id = "{{$lyric->artise_id}}" >Publish</button>
						@else
							<button class="btn btn-primary btn-xs admin-unpublish-lyric" data-id = "{{$lyric->id}}" data-user-id = "{{$lyric->artise_id}}">Unpublish</button>
						@endif
						
						
						<a class="btn btn-danger btn-xs admin-untrash-lyric"  href = "/deletelyric/{{$lyric->id}}">Trash</a>
						
					
					</td>
                  </tr>
				   @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
@stop