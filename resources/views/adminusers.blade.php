 @extends('adminmenu')
@section('admin_content')
 <div class="col-md-10">
          <div class="content-box-large">
            <div class="panel-heading">
              <div class="panel-title">Users<br>
                <br>
                Sort By : Fan | Artiste | Email</div>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered" id="example" border="0"
                cellpadding="0"
                cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
				
				
				@foreach($users as $user)
					@if($user->usertype == 2)
						@continue
					@endif
                  <tr class="odd gradeX">
                    <td>
						{{$user->name}}
					</td>
					
                    <td>
						@if($user->usertype == 1)
							Artiste
						@elseif($user->type == 0)
							Fan
						@endif
							
					</td>
                    <td>{{$user->email}}</td>
                    <td>
						@if($user->status == 1)
						<button class="btn btn-primary btn-xs admin-unblock-user" data-id = "{{$user->id}}">Unblock</button>
						@else
						<button class="btn btn-danger btn-xs admin-block-user" data-id = "{{$user->id}}">Block</button>
					    @endif
						
						<a class="btn btn-danger btn-xs admin-untrash-user"  href = "/deleteuser/{{$user->id}}">Trash</a>
						
					</td>
                  </tr>
				 @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
     @stop     