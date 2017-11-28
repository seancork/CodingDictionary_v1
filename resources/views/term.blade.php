@extends('layouts.app')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  @if(Auth::check())
 <script src="{{ asset('js/ajax-saved.js') }}"></script>
  <script src="{{ asset('js/ajax-vote.js') }}"></script>
  @endif
   <link href="{{ asset('css/extra.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        placement : 'top',
        trigger : 'hover'
    });
});
</script>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
         <div class="panel-body">
            @if (count($what_word) === 0)
 <p>This word does not seem to be added yet :( Why Not add it?  
    <a href="{{ route('add') }}">Click Here</a></p>
@elseif (count($what_word) >= 1)
<div id="block_container">
             @foreach($what_word as $indexKey => $word)
            @if($indexKey==0)
           <h1>{{$word->word}}</h1>
           @endif
           <hr />
           
    <p>{{$word->description}}</p><br />
@if(Auth::check())
    <div class=vote>
      <button type="button" id="up-{{$word->id}}"  type="submit" class="btn btn-default">
      <span class="glyphicon glyphicon-thumbs-up"></span></button>
      <button type="button" id="down-{{$word->id}}"  type="submit" class="btn btn-default">
      <span class="glyphicon glyphicon-thumbs-down"></span></button> |
    </div>
    @else
    
<div class="vote">
     <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="Please login to like">
 <span class="glyphicon glyphicon-thumbs-up"></span></button> |

  <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="Please login to dislike">
 <span class="glyphicon glyphicon-thumbs-down"></span></button> |

</div>
@endif
     @if(Auth::check())
         @foreach($saved1 as $indexKey => $word1)
         @if($word->id == $word1->word_id)
        <div class=vote>
      @if($word1->vote_type == 1)
     <script>
        document.getElementById("up-{{$word->id}}").className = "btn btn-success";  
     </script>
       @elseif($word1->vote_type  == 0)
     <script>
        document.getElementById("down-{{$word->id}}").className = "btn btn-success";  
     </script>
    @else
   
   @endif
   </div>
   @else
     @endif
       @endforeach
        @endif
        <div class=votenum>
    <p id="{{$word->id}}" class="votenum">{{$word->vote_cache}}</p>
  </div>
  @if(Auth::check())
  @if(in_array($word->id, $saved)) 
   <div class=wordsave>
      <button type="button"  id="{{$word->id}}"  type="submit" class="btn btn-success btn-sm">Saved</button>
  </div>
  @else
  <div class=wordsave>
      <button type="button" id="{{$word->id}}"  type="submit" class="btn btn-default btn-sm">Save</button>
  </div>
 @endif
 @endif
 @endforeach
</div>
 @endif
 <hr />
  </div>
</div>
  <ul class="cd-pagination no-space">
        {{ $what_word->appends(array('w' => $what_word1))->render() }}
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection