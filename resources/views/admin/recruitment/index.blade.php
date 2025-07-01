@extends('layouts.master')
@section('content')
@section('title', 'Manage Recruitment')
<div class="card">
    <div class="card-body"> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 mb-2">
            <a  style="float: right;" href="{{URL::to('admin/recruitment/create')}}" class="btn btn-primary pull-right"> Add Recruitment</a>
        </div>
        <!-- /.col-12 col-md-12 col-lg-12 -->
       

  
  
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="search-from mb-3">
                       <form action="{{ url('/admin/recruitment')}}" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="Title">Title: </label>
                                </div>
                                <div class="form-group col-md-2">
                                    <input onchange="search(this);" class="form-control" type="text" name="title" value="{{Session::get('Mtitle')??''}}">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="Status">Status: </label>
                                </div>
                                <div class="form-group col-md-2">
                                    <select   onchange="search(this);" name="approve_status" id="approve_status" class="form-control">
                                        <option value=""> Select </option>
                                        <?php
                                        $statusArray = get_status();
                                        foreach($statusArray as $key=>$value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if(Session::get('approve_status')==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php  }?>    
                                    </select>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="type">Type: </label>
                                </div>
                                <div class="form-group col-md-1">
                                    <select  onchange="search(this);" name="circularstype" id="circularstype" class="form-control">
                                        <option value=""> Select </option>
                                        <option value="1" {{ session('circularstype') == '1' ? 'selected' : '' }}>Circular</option>
                                        <option value="2" {{ session('circularstype') == '2' ? 'selected' : '' }}>Vacancy</option>

                                    </select>
                                </div>
                
                                <div class="form-group col-md-1">
                                    <label for="language">Language: </label>
                                </div>
                                <div class="form-group col-md-2">
                                    <select  onchange="search(this);" name="language_id" id="language_id" class="form-control">
                                        <option value="1" @if(Session::get('language_id')==1) selected @endif  >English</option>
                                        <option value="2" @if(Session::get('language_id')==2) selected @endif  >Hindi</option>
                                    </select>
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
					<table class="table table-striped table-bordered table-hover" >
						<thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Language</th>
                            <th width="15%">Actions</th>
							<th>Add Corrigendum</th>
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
                                            <td>{{ circularstype($row->circularstype) }}</td>                                            
                                            <td><?php echo status($row->txtstatus); ?></td>
                                            <td><?php echo language($row->language); ?></td>
                                            <td>
                                               
												<form action="{{ route('recruitment.destroy',$row->id) }}"  method="POST"> 
                                    
													<a class="btn btn-primary" href="{{ route('recruitment.edit',$row->id) }}">Edit</a>
													@csrf
													@method('DELETE')

													<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
												</form>
                                            </td>
											<td>
                                                @if($row->circularstype == 2)
                                                <a href="{{ url('/admin/corrigendum/add/' . $row->id. '/vacancy') }}" class="btn btn-primary">
                                                    <i class="fa fa-plus"></i>
                                                </a>
												@if(!empty($row->cor_title))
													<a href="{{ url('/admin/corrigendum/edit/' . $row->id . '/vacancy') }}" class="btn btn-primary">
														<i class="fa fa-edit"></i>
													</a>
												@else
													<a href="#" class="btn btn-secondary disabled" title="No corrigendum available">
														<i class="fa fa-edit"></i>
													</a>
												@endif
                                                @endif
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

@endsection