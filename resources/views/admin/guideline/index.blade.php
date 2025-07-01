@extends('layouts.master') 
@section('content') 
@section('title', 'Manage Guidelines')

    <div class="card">
        <div class="card-body">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <a style="float: right;" href="{{URL::to('admin/guidelines/create')}}" class="btn btn-primary pull-right"> Add Guideline</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="search-from mb-3">

                                    <form action="{{ url('/admin/guidelines')}}" class="search_inbox" name="form1" id="form1" method="post" accept-charset="utf-8">
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
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th width="30%">Title</th>
                                                <th>Status</th>
                                                <th>Language</th>                                           
                                                <th width="15%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($list) > 0)
                                            <?php
                                                $count = 1;
                                                foreach($list as $row):
                                            ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td><?php echo $row->menu_title; ?></td>
                                                    <td> {{ status($row->txtstatus) }} </td>
                                                    <td> {{ language($row->language) }} </td>
                                                    
                                                    <form action="{{ route('guidelines.destroy',$row->id) }}"  method="POST"> 
                                                        <td>
                                                            <a class="btn btn-primary" href="{{ route('guidelines.edit',$row->id) }}">Edit</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                        </td>
                                                    </form>                                              
                                                </tr>
                                                <?php
                                                    endforeach;
                                                ?>
                                            @else
                                                <tr>
                                                    <td colspan="5">No data found...</td>                                           
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    {!! $list->withQueryString()->links('pagination::bootstrap-5') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
