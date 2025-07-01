@extends('layouts.master')
@section('content')
@section('title', 'Edit Podcast')

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
                <form  action="{{ route('podcast.update' , $data->id) }}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    @csrf
                    @method('PUT')
                
                    <div class="panel-body">
                            
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Language:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                    <div class="input_class form-group">
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="1"  @if((!empty($data->language)?$data->language:old('language'))==1) checked @endif class="@error('language') is-invalid @enderror" />English &nbsp;
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="2"  @if((!empty($data->language)?$data->language:old('language'))==2) checked @endif class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
                                        @error('language')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Title:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="title" maxlength="500"
                                    minlength="2" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('title') is-invalid @enderror" id="title"   value="{{ !empty($data->title)?$data->title:old('title')}}"  />
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Description:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                <textarea name="description" autocomplete="off" class="input_class form-control @error('description') is-invalid @enderror  summernote-simple">{{!empty($data->description)?$data->description:old('description')}}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            
                        <div class="row" id="txtPDF" >
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Audio Upload:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="file" name="txtuplode" class="input_class  @error('txtuplode') is-invalid @enderror  inline-block" id="txtuplode" />
                                    @error('txtuplode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @if(!empty($data->txtuplode))
                                <!-- <img style="margin-bottom: 5%;" class="w-50 img-responsive" alt="image" id="logoimg" src="{{ URL::asset('public/upload/admin/cmsfiles/logo/thumbnail/')}}/{{$data->txtuplode}}" class="rounded-circle mr-1" /> -->
                                <audio controls>
                                    <source src="{{ URL::asset('public/upload/admin/cmsfiles/podcast/')}}/{{$data->txtuplode}}" type="audio/mpeg"> 
                                </audio>
                                @endif
                                <input type="hidden" name="oldimg" value="{{ !empty($data->txtuplode)?$data->txtuplode:''}}" >
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
                                <select name="txtstatus" class="input_class form-control @error('txtuplode') is-invalid @enderror " id="txtstatus" autocomplete="off">
                                    <option value=""> Select </option>
                                        <?php
                                        $statusArray = get_status();
                                        foreach($statusArray as $key=>$value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if((!empty($data->txtstatus)?$data->txtstatus:old('txtstatus'))==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php  }?>
                                </select>
                                @if($errors->has('txtstatus'))
                                    <span class="text-danger">{{ $errors->first('txtstatus') }}</span> @endif
                            
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xm-12">
                                <div class="pull-right">
                                
                                    <input name="cmdsubmit" type="submit" class="btn btn-success" id="cmdsubmit" value="Submit" />&nbsp;
                                    <a href="{{URL::to('admin/podcast/')}}" class="btn btn-primary" >back</a>
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