@extends('layouts.master')
@section('content')
@section('title', 'add Faq')


<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
            <div class="card-body"> 
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
                <form  action="{{URL::to('admin/faq/')}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    @csrf
                   
                    <div class="panel-body">
                        <div class="row">
                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Page Language:</label>
                                <span class="star">*</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="input_class form-group">
                                <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="1"  @if(old('language')==1) checked @endif class="@error('language') is-invalid @enderror" />English &nbsp;
                                <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="2"  @if(old('language')==2) checked @endif class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
                                @if($errors->has('language'))
                                <p class="text-danger">{{ $errors->first('language') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xm-3">
                                        <div class="form-group">
                                            <label>Title:</label>
                                            <span class="star">*</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xm-6">
                                        <div class="form-group">
                                            <input name="title" autocomplete="off" onkeypress="return onlyAlphabets(event,this);" type="text" class="input_class form-control" id="user_name" value="{{old('title')}}"/>
                                            @if($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif

                                              </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xm-3">
                                        <div class="form-group">
                                            <label>Url:</label>
                                            <span class="star">*</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xm-6">
                                        <div class="form-group">
                                            <input name="url" onkeypress="return onlyAlphabets(event,this);" autocomplete="off"  type="text" class="input_class form-control" id="user_name" value="{{old('url')}}"/>
                                 @if($errors->has('url'))
                  <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif

                                              </div>
                                    </div>
                                </div>
                               <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Description:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <textarea name="description" autocomplete="off" onkeypress="return onlyAlphabets(event,this);" class="input_class @error('description') is-invalid @enderror  summernote-simple">{{old('description')}}</textarea>
                                    @if($errors->has('description'))
                  <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                                </div>
                            </div>
                        </div>
                               
                                
                                <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Status:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                <select name="txtstatus" class="input_class form-control" id="txtstatus" autocomplete="off">
                                    <option value=""> Select </option>
                                        <?php
                                        $statusArray = get_status();
                                        foreach($statusArray as $key=>$value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if(old('txtstatus')==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php  }?>
                                </select>
                                     @if($errors->has('txtstatus'))
                  <span class="text-danger">{{ $errors->first('txtstatus') }}</span>
                @endif
                                </div>
                            </div>
                        </div>
                            

                         <div class="row">
                            <div class="col-lg-12 col-md-12 col-xm-12">
                                <div class="pull-right">
                               
                                    <input name="cmdsubmit" type="submit" class="btn btn-success" id="cmdsubmit" value="Submit" />&nbsp;
                                    <a href="{{URL::to('admin/faq/')}}" class="btn btn-primary" >back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </form>
               

            </div>
        </div>
    </div>
</div>
@endsection