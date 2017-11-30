@extends('layouts.app')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="{{ asset('js/ajax-saved.js') }}"></script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

               <div class="panel-body">
                    <ul class="nav nav-tabs">
               <li class="active"><a href="{{route('home')}}">Saved Words</a></li>
                <li><a href="{{route('submitted_words')}}">Submitted Words</a></li>
                  @if(Auth::user()->is_permission == 1)
                   <li><a href="{{route('admin_main')}}">Admin</a></li>
                   <li><a href="{{route('admin_main')}}">Word(s) Check</a></li>
                   @endif
                    </ul>
  @if (count($saved_words) === 0)
  <br />
 <p>You have saved no words yet!</p>  
    @elseif (count($saved_words) >= 1)
                  @foreach($saved_words as $words)
                  <div id=saved-{{$words->get_words->id}}>
                   <h1>{{$words->get_words->word}}</h1>
                     <p> {{$words->get_words->description}}</p>
                     <div class=dashboard-unsave>
             <button type="button"  id="{{$words->get_words->id}}"  type="submit" class="btn btn-success btn-sm">Saved</button>
                     </div> </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
