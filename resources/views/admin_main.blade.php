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
                  @if(Auth::user()->is_permission == 1)
              <li class="active"><a href="{{route('admin_main')}}">Admin</a></li>
              <li><a href="{{route('words_check')}}">Word(s) Check</a></li>
                   @endif
                    </ul>
                    <h1>Users</h1>
              <p>User Count: {{$count_users}}</p>

              <h1>Searches</h1>
                 <table class="table">
    <thead>
      <tr><th>Searched</th><th>Time</th><th>Exists</th></tr>
    </thead>
                 @foreach($searches as $search)          
    <tbody>
      @if($search->if_exists == 0)
      <tr class="danger">
       @else
     @endif
        <td>{{$search->searched}}</td><td>{{$search->created_at->diffForHumans()}}</td>
        <td>{{$search->if_exists}}</td></tr>
                 @endforeach
    </tbody>
    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
