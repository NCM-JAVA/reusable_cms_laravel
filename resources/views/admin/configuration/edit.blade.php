@extends('layouts.master')
@section('content')
@section('title', 'Form Generator')
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
                <form  action="{{URL::to('admin/configuration', $data->id)}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    @csrf @method('PUT')
                    

                    <div class="row">
						<div class="col-12 col-md-3 col-lg-3">
							<div class="form-group">
								<label>Page Language:</label>
								<span class="star">*</span>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-6">
							<div class="input_class form-group">
								<input type="radio" name="language" autocomplete="off" id="txtlanguage"  value="1"  @if((!empty($data->language)?$data->language:old('language'))==1) checked @endif class="@error('language') is-invalid @enderror" />English &nbsp;
								<input type="radio" name="language" autocomplete="off" id="txtlanguage"  value="2"  @if((!empty($data->language)?$data->language:old('language'))==2) checked @endif class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
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
                                    <label>Configuration Type:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <select name="cof_type" maxlength="36"
                                    minlength="2" autocomplete="off" 
                                    class="input_class form-control  @error('cof_type') is-invalid @enderror" id="cof_type"/>
                                    <option value="">Select</option>
                                    <option value="SMS" <?php if((!empty($data->cof_type)?$data->cof_type:old('cof_type')) == "SMS") echo "selected"; ?>>SMS</option>
                                    <option value="EMAIL" <?php if((!empty($data->cof_type)?$data->cof_type:old('cof_type'))== "EMAIL") echo "selected"; ?>>EMAIL</option>
                                    </select>
                                    @error('cof_type')
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
                                    <label>SMS Url:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="sms_url" maxlength="36"
                                    minlength="2" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('sms_url') is-invalid @enderror" id="sms_url" value="{{ !empty($data->sms_url)?$data->sms_url:old('sms_url')}}"  />
                                    @error('sms_url')
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
                                    <label>Sender Name:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="sender_name" maxlength="36"
                                    minlength="2" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('sender_name') is-invalid @enderror" id="sender_name" value="{{ !empty($data->sender_name)?$data->sender_name:old('sender_name')}}"  />
                                    @error('sender_name')
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
                                    <label>Sender Email</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="sender_mail" maxlength="36"
                                    minlength="2" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('sender_mail') is-invalid @enderror" id="sender_mail" value="{{ !empty($data->sender_mail)?$data->sender_mail:old('sender_mail')}}"  />
                                    @error('sender_mail')
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
                                    <label>Password</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="password" maxlength="36"
                                    minlength="2" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('password') is-invalid @enderror" id="password" value="{{ !empty($data->password)?$data->password:old('password')}}"  />
                                    @error('password')
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
                                    <label>Port</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="port" maxlength="36"
                                    minlength="2" autocomplete="off" type="number" 
                                    class="input_class form-control  @error('port') is-invalid @enderror" id="port" value="{{ !empty($data->port)?$data->port:old('port')}}"  />
                                    @error('port')
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
                                    <label>Contact Us Message</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <textarea name="contact_msg" 
                                    minlength="2" autocomplete="off" type="number" 
                                    class="input_class form-control  @error('contact_msg') is-invalid @enderror" id="contact_msg" />{{ !empty($data->contact_msg)?$data->contact_msg:old('contact_msg')}}</textarea>
                                    @error('contact_msg')
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
                                    <label>Reset Password Message</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <textarea name="reset_pass_msg" 
                                    minlength="2" autocomplete="off" type="number" 
                                    class="input_class form-control  @error('reset_pass_msg') is-invalid @enderror" id="reset_pass_msg"   />{{ !empty($data->reset_pass_msg)?$data->reset_pass_msg:old('reset_pass_msg')}}</textarea>
                                    @error('reset_pass_msg')
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
                                    <label>Registration Message</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <textarea name="reg_msg" 
                                    minlength="2" autocomplete="off" type="number" 
                                    class="input_class form-control  @error('reg_msg') is-invalid @enderror" id="reg_msg" />{{ !empty($data->reg_msg)?$data->reg_msg:old('reg_msg')}}</textarea>
                                    @error('reg_msg')
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
                                    <label>Feedback Message</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <textarea name="feedback_msg" 
                                    minlength="2" autocomplete="off" type="number" 
                                    class="input_class form-control  @error('feedback_msg') is-invalid @enderror" id="feedback_msg" />{{ !empty($data->feedback_msg)?$data->feedback_msg:old('feedback_msg')}}</textarea>
                                    @error('feedback_msg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xm-3">
                            <div class="form-group">
                                <label>Status:</label>
                                <span class="star">*</span>
                            </div>
                        </div>
                            <div class="col-lg-6 col-md-6 col-xm-6">
                                <div class="form-group">
                                    <select name="status" class="input_class form-control" id="status" autocomplete="off" value="" />
                                    
                                        <option value=""> Select </option>
                                        <option value="0" @if($data->status == '0') ? selected : null @endif>Inactive</option>
                                        <option value="1" @if($data->status == '1') ? selected : null @endif>Active</option>
                                    </select>
                                                @if($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xm-12">
                                <div class="pull-right">
                               
                                    <input name="cmdsubmit" type="submit" class="btn btn-success" id="cmdsubmit" value="Submit" />&nbsp;
                                    <a href="{{URL::to('admin/configuration/')}}" class="btn btn-primary" >back</a>
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