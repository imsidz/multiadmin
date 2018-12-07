@extends('admin.layout.app')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Role</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				Role Lists <button class="btn btn-default pull-right" data-toggle="modal" data-target="#addRole">Add Roles</button>
			</div>

			<!-- The Modal -->
			<div class="modal fade" id="addRole">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">

			      <!-- Modal Header -->
			      <div class="modal-header">
			        <h4 class="modal-title">Modal Heading</h4>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			      </div>

			      <!-- Modal body -->
			      <div class="modal-body">
			        {!! Form::open(['method' => 'POST', 'route' => 'role.post']) !!}
			        
			            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			                {!! Form::label('name', 'Role Name') !!}
			                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
			                <small class="text-danger">{{ $errors->first('name') }}</small>
			            </div>
			        
			        
			      </div>

			      <!-- Modal footer -->
			      <div class="modal-footer">
				        {!! Form::submit("Submit", ['class' => 'btn btn-success mr-auto']) !!}
				        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
			        {!! Form::close() !!}
			      </div>

			    </div>
			  </div>
			</div>
			<div class="card-body">
				<table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Role</th>
				        <th>Permissions</th>
				        <th width="10%">Add Permission</th>
				        <th width="5%">Edit</th>
				        <th width="5%">Delete</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@foreach($roles as $role)
				    	<tr>
				    		<td>{{ ucfirst($role->name) }}</td>
				    		<td>
				    			<ol>
				    				@forelse($role->permissions as $permission)
				    					<li>{{ $permission->name }}</li>
				    				@empty
				    					No Permission Assign Yet
				    				@endforelse
				    			</ol>
				    		</td>
				    		<td><button class="btn btn-info" data-toggle="modal" data-target="#AddPermission{{ $role->id }}">Add Permission</button></td>

							<!-- The Modal -->
							<div class="modal fade" id="AddPermission{{ $role->id }}">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">

							      <!-- Modal Header -->
							      <div class="modal-header">
							        <h4 class="modal-title">Add or Remove Permission</h4>
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							      </div>

							      <!-- Modal body -->
							      <div class="modal-body">
							        {!! Form::open(['method' => 'POST', 'route' => ['permission.post', $role->id]]) !!}
							        	<div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
							        	    {!! Form::label('permission', 'Select Permission') !!}
							        	    <br>
							        	    <select class="form-control permission" name="permissions[]" multiple="multiple" style="width: 100%">
							        	    	@foreach($permissions as $permission)
											  		<option value="{{ $permission->name }}" @if( $role->permissions->contains('name', $permission->name )) selected="selected" @endif >{{ ucfirst($permission->name )}}</option>
											  	@endforeach
											</select>
							        	    <small class="text-danger">{{ $errors->first('permission') }}</small>
							        	</div>
											
							      </div>

							      <!-- Modal footer -->
							      <div class="modal-footer">
							      	{!! Form::submit("Update", ['class' => 'btn btn-success mr-auto']) !!}
							            
							        
							        {!! Form::close() !!}
							        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							      </div>

							    </div>
							  </div>
							</div>
				    		<td><button class="btn btn-warning" data-toggle="modal" data-target="#Edit{{ $role->id }}">Edit</button></td>

							<!-- The Modal -->
							<div class="modal fade" id="Edit{{ $role->id }}">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content">

							      <!-- Modal Header -->
							      <div class="modal-header">
							        <h4 class="modal-title">Edit {{ ucfirst($role->name) }}</h4>
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							      </div>

							      <!-- Modal body -->
							      <div class="modal-body">
							        {!! Form::model($role, ['method' => 'PUT', 'route' => ['role.edit', $role->id]]) !!}
							            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							                {!! Form::label('name', 'Name') !!}
							                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
							                <small class="text-danger">{{ $errors->first('name') }}</small>
							            </div>
							      </div>

							      <!-- Modal footer -->
							      <div class="modal-footer">
							      	{!! Form::submit("Submit", ['class' => 'btn btn-success mr-auto']) !!}
							        
							        {!! Form::close() !!}
							        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
							      </div>

							    </div>
							  </div>
							</div>
				    		<td><button class="btn btn-danger" data-toggle="modal" data-target="#Delete{{ $role->id }}">Delete</button></td>
				    		<!-- The Modal -->
							<div class="modal fade" id="Delete{{ $role->id }}">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content bg-danger">

							      <!-- Modal body -->
							      <div class="modal-body">
							        <h1>Are You Sure!</h1>
							      </div>
							      <!-- Modal footer -->
							      <div class="modal-footer">
							      	{!! Form::open(['method' => 'DELETE', 'route' => ['role.delete', $role->id]]) !!}
							      		
							      	    {!! Form::submit("Yes", ['class' => 'btn btn-outline-light mr-auto']) !!}
							      	
							      	{!! Form::close() !!}
							        <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
							      </div>

							    </div>
							  </div>
							</div>
				    	</tr>
				    	@endforeach
				    </tbody>
				  </table>
			</div>
		</div>
	</div>
</section>


@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
		    $('.permission').select2();
		});
	</script>
@endpush