@extends('layouts.master')
@section('content')
@section('title', ' Edit Gallery')

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
                <form class="d-flex flex-column gap-2" action="{{ route('gallery.update' , $data->id) }}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
                                    <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="1"  @if((!empty($data->language)?$data->language:old('language'))==1) checked @endif class="@error('language') is-invalid @enderror" />English &nbsp;
                                    <input type="radio" name="language" autocomplete="off" id="txtlanguage" onclick="getPage(this.value);" value="2"  @if((!empty($data->language)?$data->language:old('language'))==2) checked @endif class="@error('language') is-invalid @enderror"  />Hindi &nbsp;
                                    @if($errors->has('language'))
                                    <p class="text-danger">{{ $errors->first('language') }}</p>
                                    @endif
                                </div>
						</div>
					</div>
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Event Title:</label>
                                    <span class="star">*</span>
									<label class="text-info">Allowed Apecial Characters -,()'"/&.</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                               <div class="form-group">
									<!-- onkeypress="return onlyAlphabets(event,this);" -->
                                    <input name="menu_title"
                                     autocomplete="off" type="text" 
									 oninput="this.value = this.value.replace(/[^\u0900-\u097Fa-zA-Z0-9 -,()'-.&quot;/&]/g, '')"
                                    pattern="[\u0900-\u097Fa-zA-Z0-9 ,()'-.&quot;/&\]*"
                                    title="Only Hindi, English letters, numbers, and spaces are allowed"
                                    class="input_class form-control  @error('menu_title') is-invalid @enderror" id="menu_title"   value="{{ !empty($data->title)?$data->title:old('menu_title')}}"  />
                                    @error('menu_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       
                       
                            
                        <div class="row" id="txtPDF" >
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Image Upload:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="file" name="imguplode[]" class="input_class  @error('imguplode') is-invalid @enderror  inline-block" id="imguplode" />
									@error('imguplode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
								</div>

                                <div class="form-group">
                                <span class="btn btn-success" value="Add More" onclick="add_file();">Add More</span>
                            </div>
                            </div>
                            
                            <div class="col-12 col-md-6 col-lg-12">
                            <div class="form-group">
                            <p id="file_div"></p>
                            </div>
                            </div>
                          
								@if($data->txtuplode !== '')
                                <?php 
                                $imagelist = explode(",",$data->txtuplode);
                                ?>
                                	<?php $rm = 0; foreach($imagelist as $img){ $rm++; ?>
                                        
	                                <img id="thumbImg-<?php echo $img; ?>" height="100px" width="100px"  class="img-thumbnail" src="{{ URL::asset('public/upload/admin/cmsfiles/photos/thumbnail/')}}/<?php echo $img ; ?>"> 
									
									<p><button id="remBTN-<?php echo $img; ?>" type="button" class="btn btn-danger"  onclick="removeImg('<?php echo $img ; ?>, <?php echo $data->id; ?>')">X</button></p>
										
                                <?php } ?>
								@endif
                            </div>
                           
                        </div><br>
                        
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-xm-3">
                                <div class="form-group">
                                    <label>Event Date:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xm-6">
                                <div class="form-group">
                                    <input type="date" name="eventdate" id="eventdate" class="input_class form-control" autocomplete="off" value="{{ !empty($data->eventdate)?$data->eventdate:old('eventdate')}}">
                                    @if($errors->has('eventdate'))
                                    <span class="text-danger">{{ $errors->first('eventdate') }}</span> @endif
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Display on Home:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                <select name="display_on_home" class="input_class form-control" id="display_on_home" autocomplete="off">
                                    <option value=""> Select </option>
                                    <option value="1" <?php echo (isset($data['display_on_home']) && $data['display_on_home'] == '1') ? 'selected' : ''; ?>>Yes</option>
                                    <option value="0" <?php echo (isset($data['display_on_home']) && $data['display_on_home'] == '0') ? 'selected' : ''; ?>>No</option>
                                </select>
                                  @if($errors->has('display_on_home'))
                                    <p class="text-danger">{{ $errors->first('display_on_home') }}</p>
                                    @endif
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
                                <select name="txtstatus" class="input_class form-control" id="txtstatus" autocomplete="off">
                                    <option value=""> Select </option>
                                        <?php
                                        $statusArray = get_status();
                                        foreach($statusArray as $key=>$value) {
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php if((!empty($data->txtstatus)?$data->txtstatus:old('txtstatus'))==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php  }?>
                                </select>
                                   @if($errors->has('txtstatus'))
                                    <p class="text-danger">{{ $errors->first('txtstatus') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xm-12">
                                <div class="pull-right">
                               
                                    <input name="cmdsubmit" type="submit" class="btn btn-success" id="cmdsubmit" value="Submit" />&nbsp;
                                    <a href="{{URL::to('admin/gallery')}}" class="btn btn-primary" >back</a>
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
<!-- Name: Kesh Kumar
Date: 01-11-23
Reason: This Javascript used for the dynamically add input and Delete images with ajax.  -->
<script>
function add_file()
{
	$("#file_div").append("<div><input type='file' name='imguplode[]'><input type='button' class='btn btn-danger' value='REMOVE' onclick=remove_file(this);><div>&nbsp;");
}
function remove_file(ele)
{
	$(ele).parent().remove();
}

function removeImg(img, id){
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var linkurl = "{{ url('/admin/delete_images')}}";
    var imgname=img;
    
	$('span.img-removed').remove();
	$.ajax({
		'url' : linkurl,
		'type' : 'POST',
		'data' : { 'rowid' : imgname},
		'success' : function(data){
			var obj = data;
			if(obj){
                var imagename = img.split(",")[0];
                $('#thumbImg-'+imagename).remove();
				$('#remBTN-'+imagename).remove();
                // alert('#thumbImg-'+imagename);
				$('#valImg-'+imagename).after('<span class="img-removed" style="color:green;">Image successfully removed.</span>');
                location.reload();
			}else{
				$('#valImg-'+imagename).after('<span class="img-removed" style="color:red;">Image not removed. Please try again.</span>');
			}
		}
		
	});
	
}
</script>
</script>