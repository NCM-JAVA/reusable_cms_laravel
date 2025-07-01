@extends('layouts.master'); @section('content') @section('title', 'Manage Gallery')
<div class="card">
    <div class="card-body">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <a style="float: right;" href="{{URL::to('admin/gallery/create')}}" class="btn btn-primary pull-right"> Add Gallery</a>
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
                                            <th>Title</th>
											<th>Image</th>
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
                                            <td><?php echo $row->title; ?></td>
											<td>
								@if(!empty($row->txtuplode))
                                <img style="margin-bottom: 5%;" class="w-50 img-responsive" alt="image" id="logoimg" src="{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/')}}/{{$row->txtuplode}}" class="rounded-circle mr-1" />
                              
                                @endif</td>
                                             <td>
                                               <form action="{{ route('gallery.destroy',$row->id) }}"  method="POST"> 
                                            
                                                 <a class="btn btn-primary" href="{{ route('gallery.edit',$row->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')

                                   <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                   </td>
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
