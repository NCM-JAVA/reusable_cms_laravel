@extends('layouts.master')
@section('content')
@section('title', 'Manage Whatsnew')
<div class="card">
    <div class="card-body"> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 mb-2">
            <a  style="float: right;" href="{{URL::to('admin/success/create')}}" class="btn btn-primary pull-right"> Add Success</a>
        </div>
        <!-- /.col-12 col-md-12 col-lg-12 -->
       

  
  
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="search-from mb-3">

                        <form action="{{ url('/admin/success')}}" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="Title">Title: </label>
                                </div>
                                <div class="form-group col-md-2">
                                    <input onchange="search(this);" class="form-control" type="text" name="title" value="{{Session::get('Mtitle')??''}}" placeholder="Enter title">
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="Status">Status: </label>
                                </div>
                                <div class="form-group col-md-1">
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
                                    <label for="storytype">Type: </label>
                                </div>
                                <div class="form-group col-md-2">
                                    <select   onchange="search(this);" name="storytype" id="storytype" class="form-control">
                                    <option value=""> Select </option>
                                    <?php 
                                        $storytypeArray = array("1"=>" E Jagriti ","2"=>"National Consumer Helpline Resources");
                                        foreach($storytypeArray as $key=>$value)
                                        {
                                        ?>
                                        <option value="{{$key}}"  @if(old('storytype')==$key) selected @endif ><?php echo $value; ?></option>
                                        <?php 
                                        }
                                        ?> 
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
                            <th>Title</th>
							<th>Type</th>
                            <th>Status</th>
                            <th>Language</th>
                            <th width="15%">Actions</th>
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
                                            <td><?php echo $row->storytype == 1 ? 'E Jagriti' : 'NCH Resources'; ?></td>
                                            <td><?php echo status($row->txtstatus); ?></td>
                                            <td><?php echo language($row->language); ?></td>
                                            <form action="{{ route('success.destroy',$row->id) }}"  method="POST"> 
                                            
                                                
                                                        <td>
                                                        <a class="btn btn-primary" href="{{ route('success.edit',$row->id) }}">Edit</a>
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