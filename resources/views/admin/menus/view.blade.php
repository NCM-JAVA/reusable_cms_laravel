@extends('layouts.master');
@section('content')
@section('title', 'Manage menu')
<div class="card">
    <div class="card-body"> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
           
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach($views as $link)
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboad', $link->m_url) }}">{{ $link->m_name }}</a>
                    </li>
                @endforeach
            </ul>
            </div>
        </div>
        </nav>
        
        <div class="container">
            <h1>{{ $view->m_name }}</h1>
            {!! $view->welcomedescription !!}
        </div>
    </div>
</div>

@endsection;