@extends('layouts.app')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/highlight.pack.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/default-highlight.css') }}">
<script>hljs.initHighlightingOnLoad();</script>
  <script src="{{ asset('js/char-count.js') }}"></script>
  <script src="{{ asset('js/auto-search-term.js') }}"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Word</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('add_word') }}">
                        {{ csrf_field() }}

                         <div class="form-group{{ $errors->has('word') ? ' has-error' : '' }}">
                            <div id="word_check" class="alert alert-info" style="display:none">
                          This term already exists, but feel free to add your own version of it :).
                             </div>
                            <label for="word" class="col-md-2 control-label">Word</label>
                            <div class="col-md-8">
                                <input id="word" type="text" class="form-control" name="word" value="{{ old('word') }}" required>
                                @if ($errors->has('word'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('word') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label for="desc" class="col-md-2 control-label">Description</label>

                            <div class="col-md-8">
                                <textarea id="desc" type="text"  rows="11" maxlength="1000" class="form-control" name="desc" value="{{ old('desc') }}" required></textarea>
                                  <div id="textarea_feedback"></div>
        
                             <hr /> 
                               <h2><div class='live_word_title'></div></h2>
                                  <div class='live_desc'></div>
                                  <hr />
                                @if ($errors->has('desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                           <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

                            <label class="col-md-2 control-label">Captcha</label>
                              <div class="col-md-8">
                                {!! app('captcha')->display() !!}

                                @if ($errors->has('g-recaptcha-response'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>

                                    </span>

                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Add Word
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
