@extends('layouts.master') @section('content') @section('title', 'Manage Feedback')

<div class="card">
    <div class="card-body">
        <div id="page-wrapper">
            <div class="row">
            </div>
            
            <div class="row mb-3">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="search-from mb-3">

                                <form action="{{ url('/admin/feedback')}}" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="Title">Name: </label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input onchange="search(this);" class="form-control" type="text" name="name" value="{{Session::get('name')??''}}" placeholder="Enter name">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="Status">Email: </label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input onchange="search(this);" class="form-control" type="text" name="email" value="{{Session::get('email')??''}}" placeholder="Enter email">
                                        </div>
                                        
                                        <div class="form-group col-md-1">
                                            <label for="language">Phone number: </label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input onchange="search(this);" class="form-control" type="text" name="phone_no" value="{{Session::get('phone_no')??''}}" placeholder="Enter phone number">
                                        </div>
                                        
                                        <div class="form-group col-md-1">
                                            <input onchange="search(this);" class="form-control btn btn-success" type="submit" name="search" value="Search">
                                        </div>                                        
                                    </div> 
                                </form>

                            </div>
                        </div>

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
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Comment</th>
                                            <th>Review Comment</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach($list as $row):
                                    ?>
                                        <tr>
                                            
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row->name; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td>{{ strlen($row->phone) > 10 ? substr($row->phone, 0, 10) . '...' : $row->phone }}</td>
                                            <td><?php echo $row->comments; ?></td>
                                            <td><?php echo $row->review_comment; ?></td>
                                            <td>
                                                 <a class="btn btn-primary" href="{{ route('feedback.edit',$row->id) }}">Reply</a>
                                            </td>  
                                        </tr>
                                        <?php
                                        endforeach;
                                    ?>
                                    </tbody>
                                </table>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! $list->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>

@endsection
