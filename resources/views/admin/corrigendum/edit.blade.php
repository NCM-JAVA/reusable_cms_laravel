@extends('layouts.master')
@section('content')
    @section('title', 'Manage Corrigendum')

    <div class="card">
        <div class="card-body"> 
            <div id="page-wrapper">
                <div class="row">
                </div>

                
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                            <div class="panel-body">
                                @foreach($data as $row)
                                <form action="{{ route('corrigendum.update', $row->id) }}" name="form" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{$id}}" />
                                    <input type="hidden" name="corrigendum_type" value="{{$type}}" />
                                    <div class="row">
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Corrigendum Title:</label>
                                                <span class="star">*</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="input_class form-group">
                                                <input type="text" name="title" value="{{ $row->title }}" class="form-control" required/>                                              
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Upload PDF:</label>
                                                <span class="star">*</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="input_class form-group">
                                                <input type="file" name="txtuplode" accept="application/pdf" class="input_class w-50 inline-block" />       
                                                @if($row->txtuplode)
                                                    Current File: 
                                                        <a href="{{ asset('public/upload/admin/cmsfiles/corrigendum/' . $row->txtuplode) }}" class="text-decoration-none" target="_blank">{{ $row->title }}</a>
                                                    
                                                @endif                                       
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xm-12">
                                            <div class="pull-right">
                                        
                                                <input name="cmdsubmit" type="submit" class="btn btn-success" id="cmdsubmit" value="Submit" />&nbsp;
                                                
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                @if(session('updated_corrigendum_id') == $row->id)
                                    <div class="alert alert-success mt-2">
                                        Corrigendum #{{ $row->id }} updated successfully!
                                    </div>
                                @endif
                                <hr />
                                @endforeach
                            </div>
                            <div class="text-end">
                                <a href="{{$type == 'tender' ? URL::to('admin/tender/') : URL::to('admin/recruitment/')}}" class="btn btn-primary" >back</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection