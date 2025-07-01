@extends('layouts.master')
@section('content')
@section('title', 'Edit Module')
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
                <form  action="{{ route('module.update' , $data->id) }}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    @csrf
                    @method('PUT')
                   
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Module Name:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="module_name" maxlength="36"
                                    minlength="2" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('module_name') is-invalid @enderror" id="module_name"   value="{{ !empty($data->module_name)?$data->module_name:old('module_name')}}"  />
                                    @error('module_name')
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
                                    <label>Module Icon:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="icons" maxlength="120"
                                    minlength="0" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('icons') is-invalid @enderror" id="icons"   value="{{ !empty($data->icons)?$data->icons:old('icons')}}"  />
                                    @error('icons')
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
                                    <label> URL:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="page_url" autocomplete="off" type="text" maxlength="36"
                                    minlength="0" 
                                    class="input_class form-control @error('page_url') is-invalid @enderror " id="txtepage_title"
                                    value="{{!empty($data->page_url)?$data->page_url:old('page_url')}}" />
                                    @error('url')
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
                                    <label> Language:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="input_class form-group">
                                    <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="1"  @if((!empty($data->module_language_id)?$data->module_language_id:old('language'))==1) checked @endif class="@error('language') is-invalid @enderror" />English &nbsp;
                                    <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="2"  @if((!empty($data->module_language_id)?$data->module_language_id:old('language'))==2) checked @endif class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
                                    @if($errors->has('language'))
                                    <p class="text-danger">{{ $errors->first('language') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                                <div id="content1" style="display:<?php echo !empty($data->module_language_id)? "block" : "none" ;?>">
                               <div class="row" > <?php  $module_language_id=!empty($data->module_language_id)?$data->module_language_id:old('language'); if(isset($module_language_id)): ?>
										<?php if(!isset($data->submenu_id))$data->submenu_id=''; ?>
										<?php echo primarylink_module($module_language_id, $data->submenu_id) ?>
									<?php endif; ?>
                                    </div>
								</div>
                       
                    
                        
                        

                        
                        
                        
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Position:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <select name="mod_order_id" class="input_class form-control @error('mod_order_id') is-invalid @enderror" id="mod_order_id" autocomplete="off">
                                        <option value=""> Select </option>
                                            <?php
                                             for($i=0; $i<= 50; $i++ ) {
                                                ?>
                                                <option value="<?php echo $i; ?>" <?php if((!empty($data->mod_order_id)?$data->mod_order_id:old('mod_order_id'))==$i) echo "selected"; ?>><?php echo $i; ?></option>
                                            <?php  }?>
                                    </select>
                                    @error('mod_order_id')
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
                                    <label>Page Status:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                <select name="txtstatus" class="input_class form-control @error('txtstatus') is-invalid @enderror" id="txtstatus" autocomplete="off">
                                    <option value=""> Select </option>
                                        <?php
                                        $statusArray = get_active();
                                        foreach($statusArray as $key=>$value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if((!empty($data->module_status)?$data->module_status:old('txtstatus'))==$key) echo "selected"; ?>><?php echo $value; ?></option>
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
                                   <a href="{{ url('/admin/module')}}" class="btn btn-primary" >Back</a>
                                    <input type="hidden" name="random" value="" />
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
<script type="text/javascript">

    function getPage(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      //  var csrfHash = $('input[name="_token"]').val();
        //generate the parameter for the php script
        var data = "language=" + id;
       
        var linkurl = "{{ url('/admin/get_primarylink_module')}}";
        //alert(linkurl);
        jQuery.ajax({
            url: linkurl,
            type: "POST",
            //headers: headers,
            data: {id: id ,get_primarylink_module:'get_primarylink_module'},
            cache: false,
            success: function (html) {
                var Obj = JSON.parse(html);
                ///alert(Obj);
                //jQuery('input[name="_token"]').val("");
              //  jQuery('input[name="_token"]').val(Obj.csrfhash);

                //hide the progress bar
                jQuery("#loading").hide();

                //add the content retrieved from ajax and put it in the #content div
                jQuery("#content1").html(Obj.html);

                //display the body with fadeIn transition
                jQuery("#content1").fadeIn("slow");
            },
        });
    }

   
</script>
@endsection