@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('updatePassword') }}">
                       @csrf
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
                        <div class="row mb-3">
                            <label for="Currunt_Password" class="col-md-4 col-form-label text-md-end">{{ __('Currunt Password:') }}</label>

                            <div class="col-md-6">
                                <input id="Currunt_Password" type="password" class="form-control @error('Currunt_Password') is-invalid @enderror" name="Currunt_Password" value="{{ $Currunt_Password ?? old('Currunt_Password') }}" autocomplete="password" autofocus>
                                @error('Currunt_Password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="New_Password" class="col-md-4 col-form-label text-md-end">{{ __('New Password:') }}</label>

                            <div class="col-md-6">
                                <input id="New_Password" type="password" class="form-control @error('New_Password') is-invalid @enderror" name="New_Password" value="{{ $New_Password ?? old('New_Password') }}" autocomplete="password" autofocus>
                                @error('New_Password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password:') }}</label>

                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" value="{{ $confirm_password ?? old('confirm_password') }}" autocomplete="password" autofocus>
                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
