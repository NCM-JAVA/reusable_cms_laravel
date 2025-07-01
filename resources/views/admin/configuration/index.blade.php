@extends('layouts.master') @section('content') @section('title', 'Manage Configuration')

<div class="card">
    <div class="card-body">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 mb-2">
                    <a style="float: right;" href="{{URL::to('admin/configuration/create')}}" class="btn btn-primary pull-right"> Create New Form</a>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="search-from"></div>
                        </div>

                        @if ($message = Session::get('success'))
                        <div class="alert alert-successmy-1">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="panel-body my-1">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Language</th>
                                            <th>Configuration Type</th>
                                            <th>SMS Url</th>
                                            <th>Sender Name</th>
                                            <th>Sender Email</th>
                                            <th>Contact Us Message</th>
                                            <th>Reset Password Message</th>
                                            <th>Registration Message</th>
                                            <th>Feedback Message</th>
                                            <th>Status</th>
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
                                            <td><?php echo language($row->language); ?></td>
                                            <td><?php echo $row->cof_type; ?></td>
                                            <td><?php echo $row->sms_url; ?></td>
                                            <td><?php echo $row->sender_name; ?></td>
                                            <td><?php echo $row->sender_mail; ?></td>
                                            <td><?php echo $row->contact_msg; ?></td>
                                            <td><?php echo $row->reset_pass_msg; ?></td>

                                             <td><?php echo $row->reg_msg; ?></td>
                                             <td><?php echo $row->feedback_msg; ?></td>
                                             @if($row->status==1)
                                            <td>Active</td>
                                            @else
                                            <td>Inactive</td>
                                            @endif
                                             <form action="{{ route('configuration.destroy',$row->id) }}"  method="POST"> 
                                            <td>
                                                 <a class="btn btn-primary" href="{{ route('configuration.edit',$row->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')

                                   <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                   </td>
                                        </form>
                                              
                                        </tr>
                                        <?php
                                        endforeach;
                                    ?>
                                    </tbody>
                                </table>
                              
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-12 col-md-12 col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.row -->
</div>

@endsection
