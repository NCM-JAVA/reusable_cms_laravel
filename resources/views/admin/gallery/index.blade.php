@extends('layouts.master')
 @section('content') 
 @section('title', 'Manage Gallery')
<div class="card">
    <div class="card-body">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 mb-2">
                    <a style="float: right;" href="{{URL::to('admin/gallery/create')}}" class="btn btn-primary pull-right"> Add Gallery</a>
                </div>
                <!-- /.col-12 col-md-12 col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="search-from mb-3">

                                <form action="{{ url('/admin/gallery')}}" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
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
										<div class="form-group col-md-1">
                                            <a href="{{ url('/admin/gallery?reset=1') }}" class="form-control btn btn-secondary">Reset</a>
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
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
											<th>#</th>
                                            <th width="30%">Title</th>
											<th width="20%">Image</th>
											<th>Language</th>
                                            <th>Display on Home</th>
											<th>Status</th>
											<th width="10%">Created Date</th>
											<th width="10%">Event Date</th>
                                            <th width="20%">Actions</th>
                                        </tr>
                                    </thead>
                                    <!-- Name: Kesh Kumar
                                         Date: 31-10-23
                                        Reason: This is used for one images show on the list from the explode column.  -->
                                    <tbody>
                                        <?php
										$count = 1;
										foreach($list as $row):
                                            $image =  explode(",",$row->txtuplode);
									?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row->title; ?></td>
											<td>
                                                @if(!empty($row->txtuplode))
                                                    <img style="margin-bottom: 5%; aspect-ratio:6/3; width:80% !important" class="w-50 img-responsive" alt="image" id="logoimg" src="{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/')}}/{{$image[0]}}" class="rounded-circle mr-1" />
                                                @endif
                                            </td>
                                            <td>{{ language($row->language) }}</td>
											<td>{{ $row->display_on_home == 1 ? 'Yes' : 'No' }}</td>
                                            <td>{{ status($row->txtstatus) }}</td>
											<td> {{ date('d-m-Y', strtotime($row->created_at)) }} </td>
											<td> {{ date('d-m-Y', strtotime($row->eventdate)) }}</td>
											
                                            <td>
                                                <form action="{{ route('gallery.destroy',$row->id) }}"  method="POST"> 
                                            
                                                    <a class="btn btn-primary" href="{{ route('gallery.edit',$row->id) }}">Edit</a>
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

@endsection
