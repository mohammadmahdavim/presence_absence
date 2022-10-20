@extends('layouts.main')

@section('head')

    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h3>گزارشات</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">میزکار</a></li>
                    <li class="breadcrumb-item active" aria-current="page">گزارش کل</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <button type='button' class="btn btn-primary" onclick="hideshow()" id='hideshow'>
                                جستجوی پیشرفته
                            </button>
                        </div>
                        <div class="p-2">

                            <form method="get" action="/reportAll/export">
                                <input hidden name="code" value="{{request()->code}}">
                                <input hidden name="name" value="{{request()->name}}">
                                @if(request()->day)
                                    <select hidden name="groups[]" multiple="multiple">
                                        @foreach(request()->day as $day_id)
                                            <option selected>{{$day_id}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if(request()->loge)
                                    <select hidden name="loge[]" multiple="multiple">
                                        @foreach(request()->loge as $loge_id)
                                            <option selected>{{$loge_id}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if(request()->section)
                                    <select hidden name="section[]" multiple="multiple">
                                        @foreach(request()->section as $section_id)
                                            <option selected>{{$section_id}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if(request()->payment)
                                    <select hidden name="payment[]" multiple="multiple">
                                        @foreach(request()->payment as $payment_id)
                                            <option selected>{{$payment_id}}</option>
                                        @endforeach
                                    </select>
                                @endif


                                <button type='submit' class="btn btn-danger">
                                    دریافت فایل
                                </button>
                            </form>
                        </div>


                    </div>
                    <div id='search' style="display: none">
                        <form method="get" action="/reportAll">

                            <div class="row">
                                <div class="col-md-2">
                                    <label>کد</label>

                                    <input class="form-control" id="code" name="code" autocomplete="off"
                                           value="{{request()->code}}"
                                           placeholder="کد">
                                </div>
                                <div class="col-md-2">
                                    <label>نام</label>

                                    <input class="form-control" id="name" name="name" autocomplete="off"
                                           value="{{request()->name}}"
                                           placeholder="نام">
                                </div>

                                <div class="col-md-2">
                                    <x-Loge/>

                                </div>

                                <div class="col-md-2">
                                    <x-Section/>

                                </div>
                                <div class="col-md-2">
                                    <x-Payment/>

                                </div>

                                <div class="col-md-2">
                                    <br>
                                    <button type="submit" class="btn btn-info">جستجوکن</button>
                                </div>
                            </div>


                        </form>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align: center">
                                <th>کد</th>
                                <th>نام</th>
                                <th>کدملی</th>
                                <th>موبایل</th>
                                <th>نقش</th>
                                <th>غرفه</th>
                                <th>بخش</th>
                                <th>منطقه</th>
                                <th>منبع پرداخت</th>
                                <th>تعداد روز</th>
                                <th>جمع ساعت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->national_code}}</td>
                                    <td>{{$row->mobile}}</td>
                                    <td>{{$row->role->name}}</td>
                                    <td>{{$row->loge->name}}</td>
                                    <td>{{$row->section->name}}</td>
                                    <td>{{$row->area->name}}</td>
                                    <td>{{$row->payment->name}}</td>
                                    <td>{{$row->presence_count}}</td>
                                    <td>{{floor($row->presence_sum_sum/60)}}:{{fmod($row->presence_sum_sum,60)}}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $rows->links("pagination::bootstrap-4") !!}
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <!-- begin::select2 -->
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    <script>
        function hideshow() {
            var x = document.getElementById("search");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>
@endsection
