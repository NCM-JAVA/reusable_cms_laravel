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
                        <form action="{{ route('user_role.update' ,$user_role_edit->roleId) }}"  name="add-role-form" id="add-role-form" method="post">
                            @csrf
                          @method('PUT')
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
                                            <select disabled class="input_class form-control" name="user" id="user">
                                               
                                               
                                                <option value="{{$user_role_edit->id}}" <?php if((!empty($user_role_edit->id)?$user_role_edit->id:old('user'))==$user_role_edit->id) echo "selected"; ?>>{{$user_role_edit->name}}</option>
                                              <input type="hidden" name="oldid" value="{{$user_role_edit->id}}">
                                            </select>
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
                                               
                                                <?php
                                                $usertype = get_usertype();
                                                foreach($usertype as $key=>$value) {
                                                    ?>
                                                    <option value="<?php echo $key; ?>" <?php if((!empty($user_role_edit->role_id)?$user_role_edit->role_id:old('user_type'))==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
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
                                            <?php $old= explode(',',$user_role_edit->module_id);
                                           //   print_r($user_role_edit->permissions);
                                            ?>
                                                <div class="checkbox">
                                                    <label style="font-size: 1.5em;">
                                                        <input type="checkbox" id="check_all" value="" @if(count($modules)==count($old) ) checked @endif  />
                                                        Check All
                                                    </label>
                                                </div>
                                                <br />
                                                <ul>
                                                    
                                                    @foreach($modules as $module)
                                                    <!-- <li>
                                                        <div class="checkbox">
                                                            <label style="font-size: 1.5em;">
                                                                <input type="checkbox"  class="form-check-input" name="check_module[]" id="{{$module->id}}" 
                                                                value="{{$module->id}}" data-id="{{$module->id}}"
                                                                 @if(in_array($module->id, $old)) checked @endif  />
                                                                {{$module->module_name}}
                                                            </label>

                                                            @php
                                                                $permissions= show_permissions();
                                                                $old1=explode(',',$user_role_edit->permissions);
                                                              
                                                                @endphp
                                                                <p style="font-size: 1.5em;margin-left: 18px;">
                                                                 @foreach($permissions as  $key=>$value )
                                                                 @php 
                                                                 
                                                                 $olddd=$module->id.'_'.$value;
                                                                
                                                                 @endphp
                                                                
                                                                    <input    type="checkbox" class="form-check-input" name="permissions[]" id="{{$value}}" value="{{$module->id}}_{{$value}}" data-id="{{$module->id}}_{{$value}}"  @if(in_array($olddd, $old1)) checked @endif  />
                                                                    <span > {{$value}}</span>
                                                                 
                                                                 @endforeach
                                                            </p>
                                                               
                                                        </div>
                                                    </li> -->

                                                    <li>
                                                        <div class="checkbox my-3">
                                                            <label style="font-size: 1.5em; font-weight:bold;">
                                                                <input type="checkbox"  class="form-check-input" name="check_module[]" id="{{$module->id}}" 
                                                                value="{{$module->id}}" data-id="{{$module->id}}"
                                                                 @if(in_array($module->id, $old)) checked @endif  />
                                                                {{$module->module_name}}
                                                            </label>

                                                            @php
                                                                $permissions= show_permissions();
                                                                $old1=explode(',',$user_role_edit->permissions);
                                                              
                                                                @endphp
                                                                <div class="d-flex" style="font-size: 1.5em;margin-left: 18px;">
                                                                    @foreach($permissions as  $key=>$value )

                                                                        @php 
                                                                            $olddd=$module->id.'_'.$value;
                                                                        @endphp
                                                                    
                                                                        <div class="ml-5">
                                                                            <input    type="checkbox" class="form-check-input" name="permissions[]" id="{{$value}}" value="{{$module->id}}_{{$value}}" data-id="{{$module->id}}_{{$value}}"  @if(in_array($olddd, $old1)) checked @endif  />
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
                                            <input name="cmdsubmit" type="submit" class="btn btn-success" id="cmdsubmit" value="Submit" />&nbsp;<a href="{{URL::to('admin/user_role')}}" title="Back" class="btn btn-primary pull-right">Back</a>
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
