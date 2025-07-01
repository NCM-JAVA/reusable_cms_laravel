@extends('layouts.master')
@section('content')
@section('title', 'Add Consumer Product')
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
                <form  action="{{URL::to('admin/consumer-products/')}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
                                        <p class="text-danger">{{ $errors->first('language') }}</p>
                                        @endif
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
                                    minlength="2" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('title') is-invalid @enderror" id="title" value="{{old('title')}}"  />
                                    @error('title')
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
                                    <label>Document Upload:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="file" accept=".pdf" name="txtuplode" class="input_class inline-block" id="txtuplode" />
                                </div>
                                <span class="txtuplode_error" style="color:red;"></span>
                                @if($errors->has('txtuplode'))
                                <span class="text-danger">{{ $errors->first('txtuplode') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Type:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <select name="type" class="input_class form-control" id="type" autocomplete="off">
                                        <option value=""> Select </option>
                                            <?php
                                            $statusArray = 
                                             array(
                                                '1' => "Consumer Products",
                                                '2' => "Consumer Association"
                                            );
                                            foreach($statusArray as $key=>$value) {
                                                ?>
                                                <option value="<?php echo $key; ?>" <?php if(old('type')==$key) echo "selected"; ?>><?php echo $value; ?></option>
                                            <?php  }?>
                                    </select>
                                    @if($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
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
                                    <a href="{{URL::to('admin/consumer-products/')}}" class="btn btn-primary" >back</a>
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