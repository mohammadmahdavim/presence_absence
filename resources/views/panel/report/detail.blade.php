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
                    <li class="breadcrumb-item active" aria-current="page">گزارش ورود و خروج ها</li>
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

                            <form method="get" action="/reportDetail/export">
                                <input hidden name="code" value="{{request()->code}}">
                                <input hidden name="name" value="{{request()->name}}">
                                @if(request()->day)
                                    <select hidden name="groups[]" multiple="multiple">
                                        @foreach(request()->day as $day_id)
                                            <option selected>{{$day_id}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if(request()->day)
                                    <select hidden name="day[]" multiple="multiple">
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
                        <form method="get" action="/reportDetail">

                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label>کد</label>

                                    <input class="form-control" id="code" name="code" autocomplete="off"
                                           value="{{request()->code}}"
                                           placeholder="کد">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label>نام</label>

                                    <input class="form-control" id="name" name="name" autocomplete="off"
                                           value="{{request()->name}}"
                                           placeholder="نام">
                                </div>

                                <div class="col-md-2 form-group">
                                    <x-Loge/>

                                </div>

                                <div class="col-md-2 form-group">
                                    <x-Section/>

                                </div>
                                <div class="col-md-2 form-group">
                                    <x-Payment/>

                                </div>
                                <div class="col-md-2 form-group">
                                    <x-Day/>

                                </div>
                                <div class="col-md-2 form-group">
                                    <br>
                                    <button type="submit" class="btn btn-info">جستجوکن</button>
                                </div>
                            </div>


                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="detail-table">
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
                                <th>روز</th>
                                <th>ورود</th>
                                <th>خروج</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td>{{$row->personnel->code}}</td>
                                    <td>{{$row->personnel->name}}</td>
                                    <td>{{$row->personnel->national_code}}</td>
                                    <td>{{$row->personnel->mobile}}</td>
                                    <td>{{$row->personnel->role->name}}</td>
                                    <td>{{$row->personnel->loge->name}}</td>
                                    <td>{{$row->personnel->section->name}}</td>
                                    <td>{{$row->personnel->area->name}}</td>
                                    <td>{{$row->personnel->payment->name}}</td>
                                    <td>{{$row->day->name}}</td>
                                    <td>{{$row->enter}}</td>
                                    <td>{{$row->exit}}</td>
                                    <td class="">
                                        <div class="dropdown">
                                            <a class="btn btn-outline-primary btn-sm" href="#" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a onclick="modalShow('/attendance/{{$row->id}}/edit');"
                                                   class="dropdown-item">ویرایش</a>
                                                <x-destroy :id="$row->id" url="'/attendance/delete'"/>

                                            </div>
                                        </div>
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
    @include('include.modal-show')
@endsection

@section('script')
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
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

        $('#modal-show').on('shown.bs.modal', function (e) {
            $('.clockpicker-autoclose-demo').clockpicker({
                autoclose: true,
                align: 'right'
            });
        });
    </script>
@endsection
