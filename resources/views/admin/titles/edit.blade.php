@extends('layouts.master')
@section('content')
@section('title', 'Edit Title')

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
                <form  action="{{ route('title.update' , $data->id) }}" name="form1" id="form1" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                @csrf
                    @method('PUT')
                   
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
                                    <label> Title:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                               <div class="form-group">
                                    <input name="menu_title" maxlength="36"
                                    minlength="2" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('menu_title') is-invalid @enderror" id="menu_title"   value="{{ !empty($data->title)?$data->title:old('menu_title')}}"  />
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
                                    <label> For:</label>
                                    <span class="star">*</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                               <div class="form-group">
                                    <input name="for" maxlength="36"
                                    minlength="2" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('for') is-invalid @enderror" id="for"   value="{{ !empty($data->page_url)?$data->page_url:old('for')}}"  />
                                    @error('for')
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
                                    <label> Icons:</label>
                                   
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                               <div class="form-group">
                                    <input name="icons" maxlength="36"
                                    minlength="" onkeypress="return onlyAlphabets(event,this);" autocomplete="off" type="text" 
                                    class="input_class form-control  @error('icons') is-invalid @enderror" id="icons"   value="{{ !empty($data->icons)?$data->icons:old('icons')}}"  />
                                   
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
                                    <a href="{{URL::to('admin/title/')}}" class="btn btn-primary" >back</a>
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