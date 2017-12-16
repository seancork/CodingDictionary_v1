@extends('layouts.app')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{ asset('js/char-count.js') }}"></script>
  <script src="{{ asset('js/auto-search-term.js') }}"></script>
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
                            <label for="word" class="col-md-4 control-label">Word</label>
                            <div class="col-md-6">
                                <input id="word" type="text" class="form-control" name="word" value="{{ old('word') }}" required>
                                @if ($errors->has('word'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('word') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label for="desc" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="desc" type="desc"  rows="11" maxlength="255" class="form-control" name="desc" value="{{ old('desc') }}" required></textarea>
                                <div id="textarea_feedback"></div>
                                @if ($errors->has('desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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
