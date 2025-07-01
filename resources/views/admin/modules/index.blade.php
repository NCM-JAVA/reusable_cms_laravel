@extends('layouts.master');
@section('content')
@section('title', 'Manage Module')
<div class="card">
    <div class="card-body"> 
       <div id="page-wrapper">
         <div class="row">
           <div class="col-12 col-md-12 col-lg-12">
            <a  style="float: right;" href="{{URL::to('admin/module/create')}}" class="btn btn-primary pull-right"> Add module</a>
           </div>
        <!-- /.col-12 col-md-12 col-lg-12 -->
       

  
  
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="search-from">
                <form action="{{URL::to('admin/module/')}}" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif 
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                    <div class="form-row">
                    <div class="form-group col-md-1">
                               <input name="module_name" maxlength="36"
                                    minlength="2" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('module_name') is-invalid @enderror" id="module_name"   value="{{!empty($data->module_name)?$data->module_name:old('module_name')}}"  />
                                    @error('module_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                      </div>
                           <div class="form-group col-md-1">
                            <label for="Status">Status: </label>
                            </div>
                            <div class="form-group col-md-2">
                                {{old('approve_status')}}
                            <select name="approve_status" id="approve_status" class="form-control">
                              <option value=""> Select </option>
                                <?php
                                $statusArray = get_active();
                                foreach($statusArray as $key=>$value) {
                                    ?>
                                    <option value="<?php echo $key; ?>" <?php if(old('approve_status')==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                <?php  }?>    
                           </select>
                            </div>
                       
                        <div class="form-group col-md-1">
                        <label for="language">Language: </label>
                        </div>
                        <div class="form-group col-md-2">
                            <select name="language_id" id="language_id" class="form-control">
                                <option value="1" @if(old('language')==1) selected @endif  >English</option>
                                <option value="2" @if(old('language')==2) selected @endif  >Hindi</option>
                            </select>
                        </div>
                       
                    
                        <div class="form-group col-md-1">
                        <label for="language"></label>
                           <button type="submit" name="search" value="search"  id="SearchFrom" class="btn btn-primary btn-xs SearchFrom"> <i class="fa fa-search"></i> Search</button>
                        </div>
                     </div> 
                    </form>
                   
                </div>
                </div>
                

               
                <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" >
						<thead>
							<tr>
								<th>#</th>
								<th>Module Name</th>
								<th>Page Status</th>
                                <th>Demo Images</th>
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
								<td><?php echo $row->module_name; ?></td>
								<td><?php  
                                    if(has_m_child($row->id, $row->module_language_id) > 0):
                                        ?>
                                        <strong><a href="{{route('module.show', $row->id)}}"><?php echo status_m($row->module_status); ?></a></strong><br/>(Click for Sub module)
                                        <?php
                                    else:
                                        echo status_m($row->module_status);
                                    endif;
                                    
                                    ?></td> 
                                 <td><?php echo language($row->module_language_id); ?></td>
								<td><?php echo language($row->module_language_id); ?></td>
                                <form action="{{ route('module.destroy',$row->id) }}"  method="POST"> 
                                    
                                <td>
									<a href="{{route('module.edit', $row->id)}}" class="btn btn-success btn-xs">Edit</a>
                                       @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>  
                                   
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


@endsection;