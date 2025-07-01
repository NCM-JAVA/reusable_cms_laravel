@extends('layouts.master')
@section('content')
@section('title', 'Manage Notifications')
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
                <form  action="{{URL::to('admin/notifications/')}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" value="1"  @if(old('language')==1) checked @endif class="@error('language') is-invalid @enderror" />English &nbsp;
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" value="2"  @if(old('language')==2) checked @endif class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
                                    @if($errors->has('language'))
							        <span class="text-danger">{{ $errors->first('language') }}</span> @endif  
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
                                    <input name="title" 
                                    minlength="2" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('title') is-invalid @enderror" id="title" value="{{old('title')}}"  />
                                    @if($errors->has('title'))
							        <span class="text-danger">{{ $errors->first('title') }}</span> @endif
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
                                    <input name="url" autocomplete="off" type="text" maxlength="36"
                                    minlength="2" 
                                    class="input_class form-control @error('url') is-invalid @enderror " id="txtepage_title"
                                    value="{{old('url')}}"/>
                                    @if($errors->has('url'))
							        <span class="text-danger">{{ $errors->first('url') }}</span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-xm-3">
                                <div class="form-group">
                                    <label>Is New:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xm-6">
                                <div class="input_class form-group">
                                  
                                    <input type="radio" name="is_new" autocomplete="off" id="is_new" value="1"  @if(old('is_new')==1) checked @endif/>Yes &nbsp;
                                    <input type="radio" name="is_new" autocomplete="off" id="is_new" value="2"  @if(old('is_new')==2) checked @endif/ />No
                                     @if($errors->has('is_new'))
							         <span class="text-danger">{{ $errors->first('is_new') }}</span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Notice Type:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                <select name="circularstype" class="input_class form-control" id="txtstatus" autocomplete="off">
                                    <option value=""> Select </option>
                                        <?php
                                        $statusArray = get_noticetype();
                                        foreach($statusArray as $key=>$value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if(old('circularstype')==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php  }?>
                                </select>
									@if($errors->has('circularstype'))
									<span class="text-danger">{{ $errors->first('circularstype') }}</span> @endif

                                </div>
                            </div>
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
                                        $menuTypeArray = array("1"=>" Content ","2"=>"PDF file Upload","3"=>"Url");
                                        foreach($menuTypeArray as $key=>$value)
                                        {
                                        ?>
                                        <option value="{{$key}}"  @if(old('menutype')==$key) selected @endif ><?php echo $value; ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                    @if($errors->has('menutype'))
							        <span class="text-danger">{{ $errors->first('menutype') }}</span> @endif
                                </div>
                            </div>
                        </div>
                        

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
                                        <input name="metakeyword" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text" class="input_class form-control" id="metakeyword" value="{{old('metakeyword')}}" />
                                    </div>
                                    @if($errors->has('metakeyword'))
							        <span class="text-danger">{{ $errors->first('metakeyword') }}</span> @endif
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
                                        <input name="metadescription" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text" class="input_class form-control" id="metadescription" value="{{old('metadescription')}}" />
                                    </div>
                                    @if($errors->has('metadescription'))
							        <span class="text-danger">{{ $errors->first('metadescription') }}</span> @endif
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
                                        <textarea name="description" onkeypress="return onlyAlphabets(event,this);"  id="editor" class="form-control" rows="3" aria-hidden="true" ><?php echo old('description'); ?></textarea>
                                    </div>
                                    @if($errors->has('description'))
							        <span class="text-danger">{{ $errors->first('description') }}</span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="" id="txtPDF" style="display: none;">
                          <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Document Upload:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="file" onchange="onlytxtuplodepdf(this);" name="txtuplode" class="input_class inline-block" id="txtuplode"/>
                                </div>
                                <span class="txtuplode_error" style="color:red;"></span>
                                @if($errors->has('txtuplode'))
							    <span class="text-danger">{{ $errors->first('txtuplode') }}</span> @endif
                            </div>
                            </div>
                        </div>
                        <div class="" id="txtweb" style="display: none;">
                        <div class="row">
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
                                @error('txtweblink')
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
											<label>Start Date:</label>
											<span class="star">*</span>
                                        </div>
									</div>
									<div class="col-lg-6 col-md-6 col-xm-6">
										<div class="form-group">
										
											<input type="date" name="startdate" id="startdate" class="input_class form-control" autocomplete="off" value="{{old('startdate')}}">
											@if($errors->has('startdate'))
									        <span class="text-danger">{{ $errors->first('startdate') }}</span> @endif
                                        </div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-3 col-xm-3">
										<div class="form-group">
											<label>End Date:</label>
											<span class="star">*</span>
                                        </div>
									</div>
									<div class="col-lg-6 col-md-6 col-xm-6">
										<div class="form-group">
											
											<input type="date" onchange="ValidateTodate();" name="enddate" id="enddate" class="input_class form-control" autocomplete="off"value="{{old('enddate')}}">
                                            <span class="enddate_error" style="color:red;"></span>
											@if($errors->has('enddate'))
									        <span class="text-danger">{{ $errors->first('enddate') }}</span> @endif
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
									<span class="text-danger">{{ $errors->first('txtstatus') }}</span> @endif

                                </div>
                            </div>
                        </div>
                      
                        

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xm-12">
                                <div class="pull-right">
                               
                                    <input name="cmdsubmit" type="submit" class="btn btn-success" id="cmdsubmit" value="Submit" />&nbsp;
                                    <a href="{{URL::to('admin/notifications/')}}" class="btn btn-primary" >back</a>
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