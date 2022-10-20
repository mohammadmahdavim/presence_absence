@extends('layouts.main')

@section('content')

    <!-- begin::page header -->
    <div class="page-header">
        <div>
            <h3>تغییر رمز</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">پروفایل</a></li>
                    <li class="breadcrumb-item active" aria-current="page">رمز</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- end::page header -->

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        تغییر رمز
                    </h5>

                    <form action="/profile/password/{{auth()->user()->id}}">

                        @method('put')

                        {{csrf_field()}}
                        @include('errors')
                        <div class="row">


                            <div class=" col-md-6">
                                <label>نام کاربری</label>
                                <input class="form-control" type="text" id="national_code" name="national_code"
                                       @if(auth()->user()->role=='consult') value="{{$row->user->national_code}}"
                                       @else value="{{auth()->user()->national_code}}" @endif readonly>
                                <br>
                                <label>رمز عبور قبلی</label>
                                <input type="password" name="old_password" placeholder="" class="form-control"
                                       autocomplete="off">



                            </div>

                            <div class="col-md-6">
                                <label>رمز جدید</label>
                                <input type="password" name="new_password" placeholder="" class="form-control"
                                       autocomplete="off">
                                <br>
                                <label>تکرار رمز جدید</label>
                                <input type="password" name="confirm_password" placeholder="" class="form-control"
                                       autocomplete="off">

                            </div>

                            <div class="form-group">
                                <br>
                                <div class="col-md-12 col-lg-12">
                                    <br>
                                    <button type="submit" class="btn btn-success btn-block">ذخیره</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
