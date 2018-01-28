@extends('layouts.app')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/highlight.pack.js') }}"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script src="{{ asset('js/ajax-vote.js') }}"></script>
  
  @if(Auth::check())
 <script src="{{ asset('js/ajax-saved.js') }}"></script>
  @endif
  <link rel="stylesheet" href="{{ asset('css/default-highlight.css') }}">
  <link href="{{ asset('css/extra.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

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
            @section('title')
    - {{$word->word}}
        @stop
           @endif
            <h2>{{$word->word}}</h2>
        <?php 
         
    // htmlentities encodes code so it won't run, only display on screen
    $string =  htmlentities($word->description, ENT_QUOTES, 'UTF-8', false);
    //str_replace will reverse encode for these tags: <code> and <pre>, do they will run
    $string = str_replace(array("&lt;code&gt;", "&lt;pre&gt;","&lt;/code&gt;","&lt;/pre&gt;" ), array("<code>", "<pre>","</code>","</pre>"), $string);

//this will auto finish tag unclosed so it won't break our site, eg pre, code in this site.
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($string);
    $string = $doc->saveHTML();
        ?>

    <p>{!! $string !!}</p><br />
    <div class=vote>
      <button type="button" id="up-{{$word->id}}"  type="submit" class="btn btn-default">
      <span class="glyphicon glyphicon-thumbs-up"></span></button>
      <button type="button" id="down-{{$word->id}}"  type="submit" class="btn btn-default">
      <span class="glyphicon glyphicon-thumbs-down"></span></button> |
    </div>

     @if(count($cookie) > 0)
         @foreach($cookie as $indexKey => $word1)
          <?php $get_id = preg_replace("/[^0-9]/","",$word1); ?>
                 @if($word->id == $get_id)

      @if(substr($word1, 0, 2) == "up")
     <script>
         var foo = <?php echo $get_id; ?>;
    document.getElementById("{{$word1}}").disabled = true; 
    document.getElementById("down-"+foo).disabled = true; 

    document.getElementById("{{$word1}}").className = "btn btn-success";  
     </script>
       @elseif(substr($word1, 0, 4)  == "down")
     <script>
       var foo = <?php echo $get_id; ?>;
    document.getElementById("{{$word1}}").disabled = true; 
    document.getElementById("up-"+foo).disabled = true;

    document.getElementById("{{$word1}}").className = "btn btn-success";  
     </script>
    @else
   
   @endif

   @else
     @endif
       @endforeach
        @endif
    <div class="votenum">
    <p id="vote-{{$word->id}}" class="votenum">{{$word->vote_cache}}</p>
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
  <hr />
 @endforeach
</div>
 @endif
      @if (count($what_word) === 0)
      
      @else
<p margin: 0; padding: 0;>Have a better explanation?
    <a href="{{ url('add') }}">Add yours.</a></p>
    @endif
     </div></div>
  <ul class="cd-pagination no-space">
        {{ $what_word->appends(array('w' => $what_word1))->render() }}
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection