@extends('layouts.master') 
@section('content') 
@section('title', 'Manage Faq')

<div class="card">
    <div class="card-body">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 mb-2">
                    <a style="float: right;" href="{{URL::to('admin/faq/create')}}" class="btn btn-primary pull-right"> Add Faq</a>
                </div>
                
            </div>
            <div class="search-from mb-3">
                <form action="#" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
            
                    @csrf
                      <div class="form-row">
                       <div class="form-group">
                        <label for="Title">Title: </label>
                        </div>
                        <div class="form-group col-md-2">
                           <input onchange="search(this);" class="form-control" type="text" name="title" value="{{Session::get('title')??''}}">
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
                        
                       
                        <div class="form-group ">
                           
                        <input onchange="search(this);" class="form-control btn btn-success" type="submit" name="search" value="Search">
                    
                        </div>
                       
                       
                     </div> 
                    </form>
                   
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
                                            <th>Description</th>
                                            <th>Language</th>
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
                                            <td><?php echo $row->title; ?></td>
                                            <td><?php echo $row->description; ?></td>
                                            <td><?php echo language($row->language); ?></td>
                                            <td><?php echo status($row->txtstatus); ?></td>
                                             <form action="{{ route('faq.destroy',$row->id) }}"  method="POST"> 
                                            <td>
                                                 <a class="btn btn-primary" href="{{ route('faq.edit',$row->id) }}">Edit</a>
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

@endsection
