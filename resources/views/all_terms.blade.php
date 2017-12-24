@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               <div class="panel-heading">All Terms</div>
         <div class="panel-body">
            @if (count($all_words) === 0)
 <p>Can't seem to find any words :(</p>
@elseif (count($all_words) >= 1)
 <table class="table">
    <thead>
      <tr><th></th></tr>
    </thead>
                 @foreach($all_words as $word)          
    <tbody>
      <td><a href="{{ route('term') }}?w={{urlencode($word->word)}}">{{$word->word}}</a></td>
              @endforeach
                @endif
              </tbody>
                </table>    
                <div class="text-center">
            {!! $all_words->render() !!}</div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection