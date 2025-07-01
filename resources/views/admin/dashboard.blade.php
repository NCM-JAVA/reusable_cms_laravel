@extends('../layouts.master')
@section('content')

    @php
        $user = Auth::user();
    @endphp
    @if($user->user_type == 1)
        @if($totalPending > 0)
            <div class="alert alert-warning">
                You have {{ $totalPending }} pending item(s) to review.
            </div>
        @endif
    @endif

    <div class="row dashborad_cards">
        <div class="col-md-3">
            <div class="card_box">
                <a href="{{route('user.index')}}">
                    Manage User
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="{{route('menu.index')}}">
                    Manage Menu
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="{{route('tender.index')}}">
                    Manage Tenders
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="{{route('recruitment.index')}}">
                    Manage Recruitment
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card_box">
                <a href="{{route('socialMedia.index')}}">
                    Manage Social Media
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="{{route('gallery.index')}}">
                    Manage Gallery
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="{{route('videogallery.index')}}">
                    Manage Video Gallery
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card_box">
                <a href="{{route('feedback.index')}}">
                    Manage Feedback
                </a>
                <div class="card_icon">
                <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="dash_table_area">
        <h1 class="table_heading">Last 5 Activity</h1>
        <div class="row dashboard_table">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                                        
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Title Name</th>
                                        <th>Module Name</th>
                                        <th>Page Action</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @php 
                                        $count = 1;
                                        $audit_trial = DB::table('audit_trails')->orderBy('id', 'desc')->limit(5)->get();
                                    @endphp
                                    @if($audit_trial)
                                        @foreach($audit_trial as $audit)
                                            <tr>
                                                <td>{{$count++}}</td>
                                                <td>{{ucwords( ($audit->usertype))??''}}</td>
                                                <td>{{$audit->page_name??''}}</td>
                                                <td>{{$audit->page_title??''}}</td>
                                                <td>{{$audit->page_action??''}}</td>
                                                <td>{{$audit->updated_at??''}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($user->user_type == 1)
    <div class="dash_table_area">
        <h1 class="table_heading">Pending Reviews</h1>
        <div class="row dashboard_table">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Module Name</th>
                                        <th>Pending Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $index = 1; @endphp
                                    @foreach($pendingCounts as $module => $count)
                                        @if($count > 0)
                                        <tr style="cursor: pointer;" onclick="window.location='{{ url('admin/' . $module) }}'">
                                            <td>{{ $index++ }}</td>
                                            <td>{{ ucfirst($module) }}</td>
                                            <td><span class="badge bg-warning">{{ $count }}</span></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection