@extends('layouts.app')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{ asset('js/ajax-wordscheck.js') }}"></script>
  <script src="{{ asset('js/highlight.pack.js') }}"></script>
  <script>hljs.initHighlightingOnLoad();</script>

  <link rel="stylesheet" href="{{ asset('css/default-highlight.css') }}">
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
          <?php 
         
    // htmlentities encodes code so it won't run, only display on screen
    $string =  htmlentities($word->description, ENT_QUOTES, 'UTF-8', false);
    //str_replace will reverse encode for these tags: <code> and <pre>, do they will run
    $string = str_replace(array("&lt;code&gt;", "&lt;pre&gt;","&lt;/code&gt;","&lt;/pre&gt;", "&lt;br /&gt;"), array("<code>", "<pre>","</code>","</pre>","<br />"), $string);

   //this will auto finish tag unclosed so it won't break our site, eg pre, code in this site.
     $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($string, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $string = $doc->saveHTML();
        ?>

<div class='display-term'>{!! $string !!}</div>
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
