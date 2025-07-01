@extends('layouts.master'); @section('content') @section('title', 'Manage Officers  ')
<div class="card">
    <div class="card-body">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <a style="float: right;" href="{{URL::to('admin/officers/create')}}" class="btn btn-primary pull-right"> Add officers </a>
                </div>
                <!-- /.col-12 col-md-12 col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="search-from"></div>
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
                                            <th>Designation</th>
                                            <th>Status</th>
                                            <th>Language</th>
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
                                            <td><?php echo $row->officers_name; ?></td>
                                            <td><?php echo $row->designation; ?></td>
                                            <td><?php echo status($row->txtstatus); ?></td>
                                            <td><?php echo language($row->language); ?></td>
                                            <form action="{{ route('officers.destroy',$row->id) }}"  method="POST"> 
                                                    @csrf
                                                    @method('DELETE')
                                                 <td>
                                               <form action="{{ route('officers.destroy',$row->id) }}"  method="POST"> 
                                            
                                                 <a class="btn btn-primary" href="{{ route('officers.edit',$row->id) }}">Edit</a>
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
                                {!! $list->withQueryString()->links('pagination::bootstrap-5') !!}
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

@endsection;
