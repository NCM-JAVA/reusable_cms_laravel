@extends('layouts.master')
@section('content')
@section('title', 'Reply Feedback')
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
                <form  action="{{URL::to('admin/feedback', $data->id)}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    @csrf @method('PUT')
                         
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Reply</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <textarea name="review_comment" 
                                    minlength="2" autocomplete="off" type="number" 
                                    class="input_class form-control  @error('review_comment') is-invalid @enderror" id="review_comment" />{{ !empty($data->review_comment)?$data->review_comment:old('review_comment')}}</textarea>
                                    @error('review_comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input name="sender_mail" maxlength="36"
                                    minlength="2" autocomplete="off" type="hidden" 
                                    class="input_class form-control  @error('sender_mail') is-invalid @enderror" id="sender_mail" value="{{ !empty($data->sender_mail)?$data->sender_mail:old('sender_mail')}}"  />
                                    <input name="sender_name" maxlength="36"
                                    minlength="2" autocomplete="off" type="hidden" 
                                    class="input_class form-control  @error('sender_name') is-invalid @enderror" id="sender_name" value="{{ !empty($data->sender_name)?$data->sender_name:old('sender_name')}}"  />
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xm-12">
                                <div class="pull-right">
                               
                                    <input name="cmdsubmit" type="submit" class="btn btn-success" id="cmdsubmit" value="Submit" />&nbsp;
                                    <a href="{{URL::to('admin/feedback/')}}" class="btn btn-primary" >back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </form>
               

            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('/public/assets/modules/jquery.min.js')}}"></script>
<script src="{{ URL::asset('/public/assets/js/page/validate.js')}}"></script>
<script>
function add_file()
{
	$("#file_div").append("<div><input type='text' name='file_div'><input type='button' class='btn btn-danger' value='REMOVE' onclick=remove_file(this);></div>");
}
function remove_file(ele)
{
	$(ele).parent().remove();
}
</script>
@endsection