@extends('layouts.master');
@section('content')
@section('title', 'Manage Notifications')
<div class="card">
    <div class="card-body"> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <a  style="float: right;" href="{{URL::to('admin/notifications/create')}}" class="btn btn-primary pull-right"> Add </a>
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
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" >
						<thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Notifications</th>
                            <th>Language</th>
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
                                        foreach($list as $row):
                                    ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row->title; ?></td>
                                            <td><?php echo circularstype($row->circularstype); ?></td>
                                            <td><?php echo status($row->txtstatus); ?></td>
                                            <td><?php echo language($row->language); ?></td>
                                            <form action="{{ route('notifications.destroy',$row->id) }}"  method="POST"> 
                                                    @csrf
                                                    @method('DELETE')
                                            <td>
                                                <a href="{{route('notifications.edit', $row->id)}}" class="btn btn-primary btn-xs">Edit</a>
                                               
                                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>  
                                               
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
<!-- Button trigger modal -->
<script src="{{ URL::asset('/public/assets/modules/jquery.min.js')}}"></script>
<script>
     var linkurl = "{{ url('/admin/get_filter_menu')}}";
        //alert(linkurl);
        jQuery.ajax({
            url: linkurl,
            type: "POST",
            //headers: headers,
            data: {id: id ,get_filter_menu:'get_filter_menu'},
            cache: false,
            success: function (html) {
                var Obj = JSON.parse(html);
             
                jQuery("#loading").hide();

                //add the content retrieved from ajax and put it in the #content div
                jQuery("#list").html(Obj.html);

                //display the body with fadeIn transition
                jQuery("#list").fadeIn("slow");
            },
        });
</script>

@endsection;