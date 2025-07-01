@extends('layouts.master')
@section('content')
@section('title', 'Add Podcast')

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
            <div class="card-body"> 
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif 
                    <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif -->
                <form  action="{{URL::to('admin/podcast/')}}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
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
								<span class="text-danger" style="color:#dc3545 !important; font-size:11px">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
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
                                    <input name="title" maxlength="100"
                                    minlength="2" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('title') is-invalid @enderror" id="txtename" value="{{old('title')}}"  />
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
                                    <label> Description:</label>
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <textarea name="description" autocomplete="off" class="input_class form-control @error('description') is-invalid @enderror  summernote-simple">{{old('description')}}</textarea>
                                @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                                </div>
                            </div>
                        </div>
  
                        <div class="row" id="txtPDF" >
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Audio Upload:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="file" name="txtuplode" class="input_class form-control @error('txtuplode') is-invalid @enderror  inline-block" id="txtuplode" />
									@error('txtuplode')
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
                                    <a href="{{URL::to('admin/podcast/')}}" class="btn btn-primary" >back</a>
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