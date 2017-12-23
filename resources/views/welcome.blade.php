@extends('layouts.app')
@section('description', 'CodingDictionary is a place with simple, easy to understand explanations of coding terms or add your own explanation in under 255 characters.')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

         <div class="panel-body">
    <div class="search-box-frontpage text-center">
      <h4>A place to get simple explanations of coding terms.</h4>
     <form role="form" class="search" method="POST" action="{{ route('search') }}">
               {{ csrf_field() }}
         <h3 class="no-margin-top h3"></h3>
         <div class="input-group input-group-lg">
            <input type="search" name="w" placeholder="search" class="form-control">
            <span class="input-group-btn">
            <button class="btn btn-danger" type="submit">Search</button>
            </span>
        </div>
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
      </form>
         </div>
       </div>
     </div>
   </div>
  </div>
</div>
@endsection