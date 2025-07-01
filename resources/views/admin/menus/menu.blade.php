@extends('layouts.master');
@section('content')
@section('title', 'Manage menu')
<div class="card">
    <div class="card-body"> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 mb-2">
           
            @if(!empty($id))
             <a  style="float: right;" href="{{ url('/admin/menu')}}" class="btn btn-primary" >Back</a>
            @else
            <a  style="float: right;" href="{{URL::to('admin/menu/create')}}" class="btn btn-primary pull-right"> Add Menu</a>
           
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
                <form action="{{ url('/admin/menu')}}" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
             
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
								<th>Menu Name</th>
                                <th>Menu Order</th>
                                <th>Site Map Order</th>
								<th>Menu Status</th>
								<th>Language</th>
								<th>Options</th>
							</tr>
						</thead>
						
						<tbody id="list">
						
						<?php
							if(count($list) > 0)
							{
							$count = 1;
							foreach($list as $row):
						?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $row->m_name; ?></td>

                                <td>
                                    <?php echo $row->page_postion??0; ?> <i id="{{$row->id}}" onclick="editmenu(this);"  class="far editbut fa-edit"></i>
                                    <span  id="page_postion_{{$row->id}}" style="display:none" >
                                    <input class="w-25" type="number" onchange="savedata(this);" id="{{$row->id}}" name="page_postion" value="" /></span>
                                    <p class="text-success" id="success_{{$row->id}}"></p>
                                </td>

                                <td>
                                    <?php echo $row->sitemap_positions??0; ?> 
                                    <i id="{{$row->id}}" onclick="editsitemap(this);"  class="far editbut fa-edit"></i>
                                    <span  id="sitemap_positions_{{$row->id}}" style="display:none" >
                                    <input class="w-25" type="number" onchange="savesitemapdata(this);" id="{{$row->id}}" name="sitemap_positions" value="" /></span>
                                    <p class="text-success" id="sitemap_success_{{$row->id}}"></p>
                                </td>

								<td><?php  
                                    if(has_child($row->id, $row->language_id) > 0):
                                        ?>
                                        <strong><a href="{{route('menu.show', $row->id)}}"><?php echo status($row->approve_status); ?></a></strong><br/>(Click for Sub Menu)
                                        <?php
                                    else:
                                        echo status($row->approve_status);
                                    endif;
                                    
                                    ?></td> 
								<td><?php echo language($row->language_id); ?></td>
								<form action="{{ route('menu.destroy',$row->id) }}"  method="POST"> 
                                            <td>
                                                 <a class="btn btn-primary" href="{{ route('menu.edit',$row->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')

                                   <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                   </td>
                                        </form>
							</tr>
						<?php
							endforeach;
							
							} else {
						?>
							<tr>
								<td colspan="5" class="text-center"> No Record Added. </td>
							</tr>
						<?php

							}
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
     function editmenu(data) {
        $("#page_postion_"+data.id).toggle();
     }
     function savedata(data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var page_postion =  data.value;
        var id =  data.id;
       
        var linkurl = "{{ url('/admin/update_menu_orders')}}";
        
        jQuery.ajax({
            url: linkurl,
            type: "POST",
            data: {id: id,page_postion:page_postion ,update_menu_orders:'update_menu_orders'},
            cache: false,
            success: function (html) {
                setTimeout(function(){
                    location.reload();
                }, 1000); 
                $("#page_postion_"+data.id).hide();
                $("#success_"+data.id).html('This Postion is Updated');
            },
        });
       
        
     }
     function search(data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var approve_status =  data.value;
        var language_id =  data.value;
        var title =  data.value;
       
        var linkurl = "{{ url('/admin/get_filter')}}";
        
        jQuery.ajax({
            url: linkurl,
            type: "POST",
            data: {approve_status: approve_status,menusearch: 'menusearch',title:title,language_id:language_id ,get_filter:'get_filter'},
            cache: false,
            success: function (html) {
                //alert(html);
                setTimeout(function(){
                  // location.reload();
                }, 1000); 
                // $("#page_postion_"+data.id).hide();
                // $("#success_"+data.id).html('This Postion is Updated');
            },
        });
       
        
     }
</script>

    <script>
        function editsitemap(data) {
            $("#sitemap_positions_"+data.id).toggle();
        }

        function savesitemapdata(data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var sitemap_positions =  data.value;
            var id =  data.id;
        
            var linkurl = "{{ url('/admin/update_sitemap_orders')}}";
            jQuery.ajax({
                url: linkurl,
                type: "POST",
                data: {id: id,sitemap_positions:sitemap_positions ,update_sitemap_orders:'update_sitemap_orders'},
                cache: false,
                success: function (html) {
                    setTimeout(function(){
                        location.reload();
                    }, 1000); 
                    $("#sitemap_positions_"+data.id).hide();
                    $("#sitemap_success_"+data.id).html('Site map Postion is Updated');
                },
            });
        }
    </script>

@endsection;