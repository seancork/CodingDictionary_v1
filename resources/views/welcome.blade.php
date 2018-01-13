@extends('layouts.app')
   <link href="{{ asset('css/extra.css') }}" rel="stylesheet">
@section('description', 'CodingDictionary is a place with simple, easy to understand explanations of coding terms or add your own explanation.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

         <div class="panel-body">
    <div class="search-box-frontpage text-center">
      <h4>A place with simple explanations of coding terms.</h4>
     <form role="form" class="search" method="POST" action="{{ route('search') }}">
               {{ csrf_field() }}
         <h3 class="no-margin-top h3"></h3>
         <div class="input-group input-group-lg">
            <input type="search" name="w" placeholder="search" class="form-control">
            <span class="input-group-btn">
            <button class="btn btn-danger" type="submit">Search</button>
            </span>
        </div>
          </form>
        @if (count($recent_words) <= 4)
        <br />
    @elseif (count($recent_words) >= 5)
     <hr />
        <h4>Recently Added</h4></h4>
            @foreach($recent_words as $indexKey => $word)
         <p class="text-center">
         <h5><a href="{{ route('term') }}?w={{urlencode($word->word)}}">{{$word->word}}</a></p></h5>
            @endforeach
             @endif
             <p><b><a href="{{ route('all_terms') }}">View All Terms</a></b></p>
         </div>
       </div>
     </div>
   </div>
  </div>
</div>
@endsection