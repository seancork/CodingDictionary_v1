@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <ul class="nav nav-tabs">
                <li><a href="{{route('home')}}">Saved Words</a></li>
                <li><a href="{{route('submitted_words')}}">Submitted Words</a></li>
                <li class="active"><a href="{{route('admin_main')}}">Admin</a></li>
                    </ul>
              <p>User Count: 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
