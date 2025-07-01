@extends('layouts.master')
@section('content')
@section('title', 'Edit Recruitment')
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
               
                <form  action="{{ route('recruitment.update' , $data->id) }}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    @csrf
                    @method('PUT')
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
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" value="1"  @if((!empty($data->language)?$data->language:old('language'))==1) checked @endif  class="@error('language') is-invalid @enderror" />English &nbsp;
                                        <input type="radio" name="language" autocomplete="off" id="txtlanguage" value="2"  @if((!empty($data->language)?$data->language:old('language'))==2) checked @endif  class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
                                        
                                    </div>
                                    @error('language')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Title:</label>
                                    <span class="star">*</span>
									<label class="text-info">Allowed Apecial Characters -,()'"/&.</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="title" minlength="2" autocomplete="off" type="text" 
									oninput="this.value = this.value.replace(/[^\u0900-\u097Fa-zA-Z0-9 -,()'-.&quot;/&]/g, '')"
                                    pattern="[\u0900-\u097Fa-zA-Z0-9 ,()'-.&quot;/&\]*" 
                                    title="Only Hindi, English Letters, Numbers, Spaces and Some Special Characters are allowed"
                                    class="input_class form-control  @error('title') is-invalid @enderror" id="title" value="{{ !empty($data->title)?$data->title:old('title')}}"  />
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Page URL:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input name="url" autocomplete="off" type="text" maxlength="36"
                                    minlength="2" onkeypress="return onlyAlphabets(event,this);" 
                                    class="input_class form-control @error('url') is-invalid @enderror " id="txtepage_title"
                                    value="{{!empty($data->url)?$data->url:old('url')}}" />
                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-xm-3">
                                <div class="form-group">
                                    <label>Is New:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xm-6">
                                <div class="input_class form-group">
                                  
                                    <input type="radio" name="is_new" autocomplete="off" id="is_new" value="1"   @if((!empty($data->is_new)?$data->is_new:old('is_new'))==1) checked @endif />Yes &nbsp;
                                    <input type="radio" name="is_new" autocomplete="off" id="is_new" value="2"   @if((!empty($data->is_new)?$data->is_new:old('is_new'))==2) checked @endif />No
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
                                    <label>Recruitment Type:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <select name="recruitment_type" class="input_class form-control" id="circularstype" autocomplete="off">
                                        <option value=""> Select </option>
                                            <?php
                                            $statusArray = get_recruitmenttype();
                                            foreach($statusArray as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key; ?>" <?php if((!empty($data->circularstype)?$data->circularstype:old('txtstatus'))==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                            <?php  }?>
                                    </select>
                                    @error('circularstype')
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
                                        <option value="{{$key}}"  @if((!empty($data->menutype)?$data->menutype:old('menutype'))==$key) selected @endif ><?php echo $value; ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                    @error('menutype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                        <input name="metakeyword" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text" class="input_class form-control" id="metakeyword" value="{{!empty($data->metakeyword)?$data->metakeyword:old('metakeyword')}}" />
                                    </div>
                                    @error('metakeyword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                        <input name="metadescription" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text" class="input_class form-control" id="metadescription" value="{{!empty($data->metadescription)?$data->metadescription:old('metadescription')}}"/>
                                    </div>
                                    @error('metadescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                        <textarea name="description" onkeypress="return onlyAlphabets(event,this);" id="editor" class="form-control" rows="3" aria-hidden="true" ><?php echo !empty($data->description)?$data->description:old('description'); ?></textarea>
                                    </div>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <input type="file" value="{{old('txtuplode')}}" name="txtuplode"  onchange="onlytxtuplodepdf(this);"  class="input_class w-50 inline-block" id="txtuplode" />
                                    <a  class="w-50" target="_blank" href="{{ URL::asset('public/upload/admin/cmsfiles/circulars/')}}/{{$data->txtuplode}}" > View PDF</a>
                              
                                </div>
                                <input type="hidden" name="olduplode" class="input_class w-50 inline-block" value="<?php echo !empty($data->txtuplode)?$data->txtuplode:''; ?>" />
                                 <span class="txtuplode_error" style="color:red;"></span>
                                @error('txtuplode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <input type="text" name="txtweblink" id="txtweblink" class="input_class form-control" autocomplete="off" placeholder="https://www.xyz.com" value="{{!empty($data->txtweblink)?$data->txtweblink:old('txtweblink')}}" />
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
										
											<input type="date" name="startdate" class="input_class form-control" autocomplete="off" value="{{!empty($data->startdate)?$data->startdate:old('startdate')}}">
											
                                        </div>
                                        @error('startdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
										
										<script>
                                            const startDateInput = document.getElementById('strtdate');
                                            const existingDate = startDateInput.value;

                                            startDateInput.addEventListener('input', function () {
                                                const selected = new Date(this.value);
                                                const minDate = new Date(existingDate || new Date().toISOString().split('T')[0]);

                                                if (selected < minDate) {
                                                    alert("Date cannot be in the past.");
                                                    this.value = "";
                                                }
                                            });
                                        </script>
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
											
											<input  onchange="ValidateTodate();" type="date" name="enddate" class="input_class form-control" autocomplete="off" value="{{!empty($data->enddate)?$data->enddate:old('enddate')}}">
                                        </div>
                                        <span class="enddate_error" style="color:red;"></span>
                                        @error('enddate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
                                    <a href="{{URL::to('admin/recruitment/')}}" class="btn btn-primary" >back</a>
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
       

        var id=@if(!empty(old('menutype'))){{old('menutype')}} @else{{!empty($data->menutype)?$data->menutype:0 }}@endif;
        //alert(id);
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