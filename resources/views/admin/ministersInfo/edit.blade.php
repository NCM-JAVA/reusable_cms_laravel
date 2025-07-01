@extends('layouts.master')
@section('content')
    @section('title', 'Add Minister Information')

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
                    <form action="{{route('ministers-info.update', $data->id)}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" value="1"  @if((!empty($data->language)?$data->language:old('language'))==1) checked @endif  class="@error('language') is-invalid @enderror" />English &nbsp;
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" value="2"  @if((!empty($data->language)?$data->language:old('language'))==2) checked @endif  class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
                                         @error('language')
                                        <span class="text-danger" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>Minister's Type:</label>
                                        <span class="star">*</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="input_class form-group">
                                        <select name="ministers_type" class="input_class form-control  @error('ministers_type') is-invalid @enderror" id="ministers_type" autocomplete="off">
                                            <option value=""> Select </option>
                                            @php
                                                $minister_type_array = get_ministers_info_type($data->language);
                                            @endphp
                                            @foreach($minister_type_array as $key => $value)
                                                <option value="{{ $key }}" {{ (!empty($data->ministers_type) ? $data->ministers_type : old('ministers_type')) == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <span class="star">*</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input name="name" maxlength="36"
                                        minlength="2" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text" 
                                        class="input_class form-control  @error('name') is-invalid @enderror" id="txtename" value="{{ !empty($data->name)?$data->name:old('name')}}"  />
                                        @error('name')
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
                                        <label>Email:</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input name="email"
                                        minlength="2" autocomplete="off" type="text" 
                                        class="input_class form-control  @error('email') is-invalid @enderror" id="email" value="{{ !empty($data->email)?$data->email:old('email')}}"  />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
								<script>
                                    document.getElementById('email').addEventListener('input', function () {
                                        let email = this.value;
                                        let obfuscated = email.replace(/@/g, '[at]').replace(/\./g, '[dot]');
                                        this.value = obfuscated;
                                    });
                                </script>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label> Designation:</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input name="designation"
                                        minlength="2" autocomplete="off" type="text" 
                                        class="input_class form-control  @error('designation') is-invalid @enderror" id="txtename"   value="{{ !empty($data->designation)?$data->designation:old('designation')}}"  />
                                        @error('designation')
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
                                        <label>Room Number:</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input name="room_no"
                                        minlength="2" autocomplete="off" type="text" 
                                        class="input_class form-control  @error('room_no') is-invalid @enderror" id="room_no" value="{{ !empty($data->room_no)?$data->room_no:old('room_no')}}"  />
                                        @error('room_no')
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
                                        <label>Office Number:</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input name="office_no"
                                        minlength="2" autocomplete="off" type="text" 
                                        class="input_class form-control  @error('office_no') is-invalid @enderror" id="office_no" value="{{ !empty($data->office_no)?$data->office_no:old('office_no')}}"  />
                                        @error('office_no')
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
                                        <label>Intercom:</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input name="intercom"
                                        minlength="2" autocomplete="off" type="text" 
                                        class="input_class form-control  @error('intercom') is-invalid @enderror" id="intercom" value="{{ !empty($data->intercom)?$data->intercom:old('intercom')}}"  />
                                        @error('intercom')
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
                                        <label>Residence Number:</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input name="residence_no"
                                        minlength="2" autocomplete="off" type="text" 
                                        class="input_class form-control  @error('residence_no') is-invalid @enderror" id="residence_no" value="{{ !empty($data->residence_no)?$data->residence_no:old('residence_no')}}"  />
                                        @error('residence_no')
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
                                        <label>Text Style:</label>
                                        <span class="star">*</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="input_class form-group">
                                        <input type="radio" name="flag_id" autocomplete="off" id="txtlanguage" value="1" @if((!empty($data->flag_id)?$data->flag_id:old('flag_id'))==1) checked @endif />Yes &nbsp;
                                        <input type="radio" name="flag_id" autocomplete="off" id="txtlanguage" value="0" @if((!empty($data->flag_id)?$data->flag_id:old('flag_id'))==0) checked @endif />No &nbsp;
                                         @error('flag_id')
                                        <span class="text-danger" >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
                                    <select name="txtstatus" class="input_class form-control  @error('txtstatus') is-invalid @enderror" id="txtstatus" autocomplete="off">
                                        <option value=""> Select </option>
                                        <?php
                                            $statusArray = get_status();
                                            foreach($statusArray as $key=>$value) {
                                        ?>
                                            <option value="<?php echo $key; ?>" <?php if((!empty($data->txtstatus)?$data->txtstatus:old('txtstatus'))==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php  }?>
                                    </select>
                                        @error('txtstatus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xm-12">
                                    <div class="pull-right">
                                
                                        <input name="cmdsubmit" type="submit" class="btn btn-success" id="cmdsubmit" value="Submit" />&nbsp;
                                        <a href="{{URL::to('admin/ministers-info/')}}" class="btn btn-primary" >back</a>
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