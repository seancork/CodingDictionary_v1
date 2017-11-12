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
                <li class="active"><a href="{{route('submitted_words')}}">Submitted Words</a></li>
                    </ul>

            @foreach($user_words as $indexKey => $word)
        <hr />
           <h1>{{$word->word}}</h1>
           <p>{{$word->description}}</p><br />
           @if($word->status == 1)
           <p>Status: Approved</p>
           @elseif($word->status == 1)
             <p>Status: Disproved</p>
           @elseif($word->status == 0)
            <p>Status: Waiting</p>
                    @endif

            @endforeach
        <hr />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
