@extends('layouts.master')
@section('content')
@section('title', 'Add Menu')
<script type="text/javascript">


   	
	function addmenutype(id) {
       
		if(id=='1')
		{ 	
			document.getElementById('txtDoc').style.display = 'block';
			document.getElementById('txtPDF').style.display = "none";
			document.getElementById('txtweb').style.display = "none";
		}
		else if(id=='2')
		{	
			document.getElementById('txtDoc').style.display = 'none';
			document.getElementById('txtPDF').style.display = 'block';
			document.getElementById('txtweb').style.display = 'none';
			// document.getElementById('media').style.display = 'none';
		}
		else if(id=='3')
		{	
			document.getElementById('txtDoc').style.display = 'none';
			document.getElementById('txtPDF').style.display = 'none';
			document.getElementById('txtweb').style.display = 'block';
		}
		else 
		{	
			document.getElementById('txtDoc').style.display = 'none';
			document.getElementById('txtPDF').style.display = 'none';
			document.getElementById('txtweb').style.display = 'none';
		}	
	}
    
</script>
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
                <form  action="{{URL::to('admin/menu/')}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    @csrf
                   
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Menu Title:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="menu_title"
                                    minlength="2" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text"  
                                    class="input_class form-control  @error('menu_title') is-invalid @enderror" id="txtename"   value="{{old('menu_title')}}"  />
                                    @error('menu_title')
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
                                    <label>Page URL:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="url" autocomplete="off" type="text" 
                                    minlength="" 
                                    class="input_class form-control @error('url') is-invalid @enderror " id="txtepage_title"
                                    value="{{old('url')}}" />
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
                       
                                <div id="content1" class="row" style="display:isset(old('language'))? "block" : "none" ">
                                <?php  $language_id=old('language'); if(isset($language_id)): ?>
										<?php if(!isset($m_flag_id)) $m_flag_id=''; ?>
										<?php echo primarylink_menu($language_id, $m_flag_id) ?>
									<?php endif; ?>
								</div>
                       
                    
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Menu Type:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="input_class form-group">
                               
                                    <select name="menutype" id="menutype" class="form-control @error('menutype') is-invalid @enderror" autocomplete="off" onchange="addmenutype(this.value)">
                                    <option value="">Select</option>
                                        <?php 
                                        $menuTypeArray = array("1"=>" Content ","2"=>"PDF file Upload","3"=>"Web Site Url");
                                        foreach($menuTypeArray as $key=>$value)
                                        {
                                        ?>
                                        <option value="{{$key}}"  @if(old('menutype')==$key) selected @endif ><?php echo $value; ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                    @if($errors->has('menutype'))
                                    <span class="text-danger">{{ $errors->first('menutype') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Welcome Description:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <textarea name="welcomedescription" autocomplete="off" class="input_class form-control @error('welcomedescription') is-invalid @enderror  summernote-simple">{{old('welcomedescription')}}</textarea>
                                @if($errors->has('welcomedescription'))
                                <span class="text-danger">{{ $errors->first('welcomedescription') }}</span>
                                @endif
                                </div>
                            </div>
                        </div>-->

                        <div id="txtDoc" style="display: none;">
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>Meta Keyword:</label>
                                        <span class="star">*</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input name="metakeyword" maxlength="64" autocomplete="off" type="text" class="input_class form-control" id="metakeyword" value="{{old('metakeyword')}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>Meta Description:</label>
                                        <span class="star">*</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input name="metadescription" maxlength="150" autocomplete="off" type="text" class="input_class form-control" id="metadescription" value="{{old('metadescription')}}" />
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
                                        <textarea name="description" id="editor" class="form-control" rows="3" aria-hidden="true" ><?php echo old('description'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="txtPDF" style="display: none;">
                            <div class="row" >
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>Document Upload:</label>
                                        <span class="star">*</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="file" onchange="onlytxtuplodepdf(this);"  name="txtuplode" class="input_class inline-block" id="txtuplode" />
                                    </div>
                                    <span class="txtuplode_error" style="color:red;"></span>
                                </div>
                            </div>
                        </div>
                        <div  id="txtweb" style="display: none;">
                        <div class="row" >
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Web Site Link:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="txtweblink" id="txtweblink" class="input_class form-control" autocomplete="off" placeholder="https://www.xyz.com" value="{{old('txtweblink')}}" />
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Content Position:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <select name="txtpostion" class="input_class form-control" id="txtpostion" autocomplete="off">
                                        <option value=""> Select </option>
                                            <?php
                                            $statusArray = get_content_postion();
                                            foreach($statusArray as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key; ?>" <?php if(old('txtpostion')==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                            <?php  }?>
                                    </select>
                                    @if($errors->has('txtpostion'))
                                    <span class="text-danger">{{ $errors->first('txtpostion') }}</span>
                                    @endif
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
                                    <a href="{{ url('/admin/menu')}}" class="btn btn-primary" >Back</a>
                                  
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
       
        var linkurl = "{{ url('/admin/get_primarylink_menu')}}";
        //alert(linkurl);
        jQuery.ajax({
            url: linkurl,
            type: "POST",
            //headers: headers,
            data: {id: id ,get_primarylink_menu:'get_primarylink_menu'},
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

    $(document).ready(function() {

        var id=@if(!empty(old('menutype'))){{old('menutype')}} @else 0 @endif;
    
        if(id=='1')
            { 	
                jQuery('#txtDoc').css('display', 'block')
                jQuery('#txtDoc').css('txtPDF', 'none')
                jQuery('#txtweb').css('txtPDF', 'none')
                
            }
            else if(id=='2')
            {	
                document.getElementById('txtDoc').style.display = 'none';
                document.getElementById('txtPDF').style.display = 'block';
                document.getElementById('txtweb').style.display = 'none';
                // document.getElementById('media').style.display = 'none';
            }
            else if(id=='3')
            {	
                document.getElementById('txtDoc').style.display = 'none';
                document.getElementById('txtPDF').style.display = 'none';
                document.getElementById('txtweb').style.display = 'block';
            }
            else 
            {	
                jQuery('#txtDoc').css('display', 'none')
                jQuery('#txtDoc').css('txtPDF', 'none')
                jQuery('#txtweb').css('txtPDF', 'none')
            }
    });
</script>
@endsection