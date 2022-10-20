@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($users as $user)
                            @include('components.card')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
