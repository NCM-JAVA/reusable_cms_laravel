@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-body">
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
             <a style="float: right;"  href="{{URL::to('admin/user_role/create')}}" class="btn btn-primary pull-right">Add User Role</a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xm-12">
                    <div class="panel panel-default">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                     <thead> 
                                        <tr>

                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>User Type</th>
                                             <th>Assign Module </th>
                                             <th>Status </th>  
                                            <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($user_role as $user)
									    <tr id="btn_rm_7" >
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->role_name}}</td>
                                            <td>{{$user->module_id}}</td>
                                            @if($user->role_status==1)
                                            <td>Active</td>
                                            @else
                                            <td>Inactive</td>
                                            @endif
                                            <td>
                                      <form action="{{ route('user_role.destroy',$user->id) }}"  method="POST">
                                         @csrf
                                          @method('DELETE')
                                            <a class="btn btn-primary" href="{{ route('user_role.edit',$user->id) }}">Edit</a>
                                               
                                                
                                                <button type="submit" onclick="return confirm('Are you sure Delete?')" class="btn btn-danger">Delete</button></form>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </form>
									                                       
                                               </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
			</div>
            <!-- /.row -->
		</div>
        </div>
            <!-- /.row -->
		</div>
		

       




    


@endsection
