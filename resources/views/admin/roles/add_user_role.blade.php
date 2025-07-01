@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-body"> 
        <div id="page-wrapper">


            <div class="row">
                <div class="col-lg-12 col-md-12 col-xm-12">
                    <div class="panel panel-default">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br />
                            <br />
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif 
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                    
                        <form  action="{{URL::to('admin/user_role/')}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            @csrf
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xm-3">
                                        <div class="form-group">
                                            <label>User Name:</label>
                                            <span class="star">*</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xm-6">
                                        <div class="form-group">
                                            <select class="input_class form-control" name="user_id" id="user_id" >
                                                <option value=""> Select </option>
                                                @foreach($user_role as $users)
                                                <option value="{{$users->id}}" @if (old('user_id') ==$users->id) {{ 'selected' }} @endif>{{$users->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('user_id'))
							               <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                            @endif
                             
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xm-3">
                                        <div class="form-group">
                                            <label>User Type:</label>
                                            <span class="star">*</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xm-6">
                                        <div class="form-group">
                                            <select class="input_class form-control" name="user_type" id="user_type" autocomplete="off">
                                            <option value=""> Select </option>
                                           <?php
                                                $usertype = get_usertype();
                                                foreach($usertype as $key=>$value) {
                                                    ?>
                                                    <option value="<?php echo $key; ?>" <?php if(old('user_type')==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                            @if($errors->has('user_type'))
							               <span class="text-danger">{{ $errors->first('user_type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xm-3">
                                        <div class="form-group">
                                            <label>Module :</label>
                                            <span class="star">*</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xm-6">
                                        <div class="form-group">
                                            <div>
                                                <div class="checkbox">
                                                    <label style="font-size: 1.5em;">
                                                        <input type="checkbox" id="check_all" value="" />
                                                        Check All
                                                    </label>
                                                </div>
                                                <br />
                                                <ul>
                                                @foreach($modules as $module)
                                                    <!-- <li>
                                                        <div class="checkbox">
                                                            <label style="font-size: 1.5em;">
                                                                <input type="checkbox" class="form-check-input" name="check_module[]" id="{{$module->id}}" value="{{$module->id}}" data-id="{{$module->id}}" @if(old('check_module')== $module->id) checked @endif  />
                                                                {{$module->module_name}}
                                                            </label>
                                                            @if($errors->has('check_module'))
                                                            <span class="text-danger">{{ $errors->first('check_module') }}</span>
                                                                @endif
                                                                @php
                                                                $permissions= show_permissions();
                                                                @endphp
                                                                <p style="font-size: 1.5em;margin-left: 18px;">
                                                                 @foreach($permissions as  $key=>$value )
                                                                 @php 
                                                                 $old=$module->id.'_'.$value;
                                                                 @endphp
                                                                    <input    type="checkbox" class="form-check-input" name="permissions[]" id="{{$value}}" value="{{$module->id}}_{{$value}}" data-id="{{$module->id}}_{{$value}}"  @if(old('permissions')== $old) checked @endif  />
                                                                    <span > {{$value}}</span>
                                                                 
                                                                 @endforeach
                                                            </p>
                                                            
                                                        </div>
                                                    </li> -->

                                                    <li>
                                                        <div class="checkbox my-3">
                                                            <label style="font-size: 1.5em; font-weight:bold;">
                                                                <input type="checkbox" class="form-check-input" name="check_module[]" id="{{$module->id}}" value="{{$module->id}}" data-id="{{$module->id}}" @if(old('check_module')== $module->id) checked @endif  />
                                                                {{$module->module_name}}
                                                            </label>
                                                            @if($errors->has('check_module'))
                                                            <span class="text-danger">{{ $errors->first('check_module') }}</span>
                                                                @endif
                                                                @php
                                                                $permissions= show_permissions();
                                                                @endphp
                                                                <div class="d-flex" style="font-size: 1.5em;margin-left: 18px;">
                                                                 @foreach($permissions as  $key=>$value )
                                                                 @php 
                                                                 $old=$module->id.'_'.$value;
                                                                 @endphp
																 <div class="ml-5">
																
                                                                    <input    type="checkbox" class="form-check-input" name="permissions[]" id="{{$value}}" value="{{$module->id}}_{{$value}}" data-id="{{$module->id}}_{{$value}}"  @if(old('permissions')== $old) checked @endif  />
																	
                                                                    <span > {{$value}}</span>
                                                                 </div>
                                                                 @endforeach
                                                            </div>
                                                            
                                                        </div>
                                                    </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xm-12">
                                        <div class="pull-right">
                                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                            <a href="{{URL::to('admin/user_role')}}" title="Back" class="btn btn-primary pull-right">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('/public/assets/modules/jquery.min.js')}}"></script>
<script type="text/javascript">
    $("#check_all").click(function () {
        if (this.checked) {
            $(".form-check-input").each(function () {
                //loop through each checkbox
                $(this).prop("checked", true); //check
            });
        } else {
            $(".form-check-input").each(function () {
                //loop through each checkbox
                $(this).prop("checked", false); //uncheck
            });
        }
    });
</script>

@endsection
