@extends('layouts.main')

@section('head')
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h3>
                {{isset($personnel) ? 'ویرایش' : 'ثبت جدید'}}
            </h3>
            <nav aria-label="breadcrumb">

            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="m-b-0">
                            {{isset($personnel) ? ' ویرایش ' . $personnel->name  : 'ثبت فرد جدید'}}
                        </h5>
                    </div>
                    @include('errors')
                    <form action="{{isset($personnel) ? '/personnel/'.$personnel->id.'/update':'/personnel/store'}}"
                          method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="">نام و نام خانوادگی</label>
                                <input class="form-control" name="name" value="{{($personnel->name) ?? old('name')}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">کد ملی</label>
                                <input type="number" class="form-control" name="national_code"
                                       value="{{($personnel->national_code) ?? old('national_code')}}">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">موبایل</label>
                                <input type="number" class="form-control" name="mobile"
                                       value="{{($personnel->mobile) ?? old('mobile')}}">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">تایم</label>
                                <select class="form-control" name="is_full_time">
                                    <option value="0">پاره وقت</option>
                                    <option
                                        value="1" {{(($personnel->is_full_time ?? old('is_full_time')) == 1) ? 'selected':''}}>
                                        تمام وقت
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">بخش</label>
                                <select class="form-control" name="section_id">
                                    @foreach($sections as $key=>$section)
                                        <option
                                            value="{{$key}}" {{(($personnel->section_id ?? old('section_id')) == $key) ? 'selected':''}}>
                                            {{$section}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">مدیر</label>
                                <select class="form-control" name="manager_id">
                                    @foreach($managers as $key=>$manager)
                                        <option
                                            value="{{$key}}" {{(($personnel->manager_id ?? old('manager_id')) == $key) ? 'selected':''}}>
                                            {{$manager}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">منطقه</label>
                                <select class="form-control" name="area_id">
                                    @foreach($areas as $key=>$area)
                                        <option
                                            value="{{$key}}" {{(($personnel->area_id ?? old('area_id') == $key)) ? 'selected':''}}>
                                            {{$area}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">نقش</label>
                                <select class="form-control" name="role_id">
                                    @foreach($roles as $key=>$role)
                                        <option
                                            value="{{$key}}" {{(($personnel->role_id ?? old('role_id')) == $key) ? 'selected':''}}>
                                            {{$role}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">منبع پرداخت</label>
                                <select class="form-control" name="payment_source_id">
                                    @foreach($paymentSources as $key=>$paymentSource)
                                        <option
                                            value="{{$key}}" {{(($personnel->payment_source_id ?? old('payment_source_id')) == $key) ? 'selected':''}}>
                                            {{$paymentSource}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">غرفه</label>
                                <select class="form-control" name="loge_id">
                                    @foreach($loges as $key=>$loge)
                                        <option
                                            value="{{$key}}" {{(($personnel->loge_id ?? old('loge_id')) == $key) ? 'selected':''}}>
                                            {{$loge}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="">پیش بینی حضور</label>
                                <select class="js-example-basic-single" name="forecast[]" multiple dir="rtl">
                                    @foreach($days as $key=>$day)
                                        <option
                                            value="{{$key}}" {{in_array($key,($forecasts ?? old('forecast')) ?? []) ? 'selected':''}}>{{$day}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group"></div>
                            <div class="col-md-4 form-group">
                                <button type="submit" class="btn btn-success btn-block text-white">
                                    ثبت
                                </button>
                            </div>
                            <div class="col-md-4 form-group"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
@endsection
