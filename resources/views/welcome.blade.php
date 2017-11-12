@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

         <div class="panel-body">
    <div class="search-box-frontpage text-center">
     <form role="form" class="search" method="GET" action="{{ route('term') }}">
           
         <h3 class="no-margin-top h3">What Term?</h3>
         <div class="input-group input-group-lg">
            <input type="search" name="w" placeholder="search" class="form-control">
            <span class="input-group-btn">
            <button class="btn btn-danger" type="submit">Search</button>
            </span>
      </form>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection