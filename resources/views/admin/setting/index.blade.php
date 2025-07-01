@extends('layouts.master');
@section('content')
@section('title', 'Manage CommanSetting')
<div class="card">
    <div class="card-body"> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 mb-2">
            @if(count($websiteSetting)!==2)
            <a  style="float: right;" href="{{URL::to('admin/setting/create')}}" class="btn btn-primary pull-right"> Add CommenSetting </a>
            @endif
        </div>
        <!-- /.col-12 col-md-12 col-lg-12 -->
       

  
  
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="search-from">
              
                   
                </div>
                </div>
                

                @if ($message = Session::get('success'))
                <div class="alert alert-success my-1">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" >
						<thead>
                        <tr>
                            <th>#</th>
                            
                            <th>Name</th>
                            <th>website tags name</th>
                            <th>Language</th>
                            <th>Active Themes</th>
                            <th>Actions</th>
                        </tr>
						</thead>
						
						<tbody id="list">
						         <?php
                                        $count = 1;
                                        $menutypeArray = array(
                                            '1' => "Page",
                                            '2' => "File",
                                            '3' => "Link"
                                        );
                                        foreach($websiteSetting as $row):
                                    ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row->website_name; ?></td>
                                            
                                            <td><?php echo $row->website_tags_name; ?></td>
                                            <td><?php echo language($row->language); ?></td>
                                            <td><a href="" target="_blank"><?php echo $row->themes; ?></a></td>
                                             <td>
                                               <form class="d-flex gap-1" action="{{ route('setting.destroy',$row->id) }}"  method="POST"> 
                                            
                                                 <a class="btn btn-primary" href="{{ route('setting.edit',$row->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                            </td>
                                        </tr>
									<?php
										endforeach;
									?>
						</tbody>
					</table>
                    {!! $websiteSetting->withQueryString()->links('pagination::bootstrap-5') !!}
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
<!-- Button trigger modal -->
<script src="{{ URL::asset('/public/assets/modules/jquery.min.js')}}"></script>


@endsection;