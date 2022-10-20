@extends('layouts.main')

@section('content')
    <div class="text-center">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <img class="m-b-50 img-fluid" src="/assets/media/image/404.png" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="font-weight-800 m-b-20">{{$text}}</h2>
            </div>
        </div>
    </div>
@endsection
