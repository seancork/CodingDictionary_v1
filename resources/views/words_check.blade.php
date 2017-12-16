@extends('layouts.app')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{ asset('js/ajax-wordscheck.js') }}"></script>

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
              <li><a href="{{route('admin_main')}}">Admin</a></li>
              <li class="active"><a href="{{route('words_check')}}">Word(s) Check</a></li>
                   @endif
                    </ul>

            @foreach($words as $indexKey => $word)
        <hr />
           <h1>{{$word->word}}</h1>
           <p>{{$word->description}}</p><br />
             <div class=checkword>
         <button type="button"  id="up-{{$word->id}}" class="btn">Approve</button>
          <button type="button" id="down-{{$word->id}}" class="btn">disprove</button>
         </div>
            @endforeach
        <hr />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
