@extends('layouts.master') @section('content') @section('title', 'Manage User')



<div class="card">
    <div class="card-body">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 mb-2">
                    <a style="float: right;" href="{{URL::to('admin/user/create')}}" class="btn btn-primary pull-right"> Add User</a>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="search-from mb-3">
                        <form action="{{ url('/admin/user')}}" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="Title">Title: </label>
                                </div>
                                <div class="form-group col-md-2">
                                    <input onchange="search(this);" class="form-control" type="text" name="user_name" value="{{Session::get('user_name')??''}}">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="Status">Status: </label>
                                </div>
                                <div class="form-group col-md-2">
                                    {{old('user_status')}}
                                    <select name="user_status" id="user_status" class="form-control">
                                        <option value=""> Select </option>
                                            <?php
                                            $statusArray = get_active();
                                            foreach($statusArray as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key; ?>" <?php if(old('user_status')==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                            <?php  }?>    
                                    </select>
                                </div>
                                <div class="form-group col-md-1">
                                    <input onchange="search(this);" class="form-control btn btn-success" type="submit" name="search" value="Search">
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
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
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>User Email Id</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php  
                                       $count = 1;?>
                                        @foreach ($user as $users)

                                        <tr>
                                            <td>{{ $count++}}</td>
                                            <td>{{$users->name}}</td>
                                            <td>{{$users->user_name}}</td>
                                            <td>{{$users->email}}</td>
                                            @if($users->user_status==1)
                                            <td>Active</td>
                                            @else
                                            <td>InActive</td>
                                            @endif

                                            <form action="{{ route('user.destroy',$users->id) }}" method="POST">
                                                <td>
                                                    <a class="btn btn-primary" href="{{ route('user.edit',$users->id) }}">Edit</a>
                                                    @csrf @method('DELETE')

                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </td>
                                            </form>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $user->withQueryString()->links('pagination::bootstrap-5') !!}
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
