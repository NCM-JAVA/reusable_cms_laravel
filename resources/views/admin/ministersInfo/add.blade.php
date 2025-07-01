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
                    <form  action="{{URL::to('admin/ministers-info/')}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        @csrf
                    
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
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="1"  @if(old('language')==1) checked @endif class="@error('language') is-invalid @enderror" />English &nbsp;
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="2"  @if(old('language')==2) checked @endif class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
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
                                        <input name="name"
                                        minlength="2" autocomplete="off" type="text" 
                                        class="input_class form-control  @error('name') is-invalid @enderror" id="txtename" value="{{old('name')}}"  />
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
                                        class="input_class form-control  @error('email') is-invalid @enderror" id="email" value="{{old('email')}}"  />
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
                                        class="input_class form-control  @error('designation') is-invalid @enderror" id="txtename"   value="{{old('designation')}}"  />
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
                                        class="input_class form-control  @error('room_no') is-invalid @enderror" id="room_no" value="{{old('room_no')}}"  />
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
                                        class="input_class form-control  @error('office_no') is-invalid @enderror" id="office_no" value="{{old('office_no')}}"  />
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
                                        class="input_class form-control  @error('intercom') is-invalid @enderror" id="intercom" value="{{old('intercom')}}"  />
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
                                        class="input_class form-control  @error('residence_no') is-invalid @enderror" id="residence_no" value="{{old('residence_no')}}"  />
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
                                        <input type="radio" name="flag_id" autocomplete="off" id="txtlanguage" value="1" />Yes &nbsp;
                                        <input type="radio" name="flag_id" autocomplete="off" id="txtlanguage" value="0" />No &nbsp;
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
                                                <option value="<?php echo $key; ?>" <?php if(old('txtstatus')==$key) echo "selected"; ?>><?php echo $value; ?></option>
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

    <script>
        function getPage(languageValue) {
            $.ajax({
                url: "{{ url('/admin/get_minister_info_type')}}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    language: languageValue
                },
                success: function(response) {
                    // console.log(response); 
                    if (response.html) {
                        var options = response.html;
                        console.log(options);
                        $("#ministers_type").empty();
                        $("#ministers_type").append(options);
                    } else {
                        console.error('No HTML data received');
                    }
                }
            });
        }
    </script>

@endsection