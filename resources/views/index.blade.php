@extends('layouts.main')

@section('head')

    <link rel="stylesheet" href="/assets/vendors/clockpicker/bootstrap-clockpicker.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendors/select2/css/select2.min.css" type="text/css">
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h3>داشبورد</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">میزکار</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="m-b-0">ثبت ورود و خروج</h5>
                    </div>

                    <ul class="nav nav-pills flex-column flex-sm-row" id="myTab" role="tablist">
                        <li class="flex-sm-fill text-sm-center nav-item">
                            <a class="nav-link active" id="qrCode-tab" data-toggle="tab" href="#qrCode" role="tab"
                               aria-controls="qrCode" aria-selected="false">ثبت با بارکدخوان</a>
                        </li>
                        <li class="flex-sm-fill text-sm-center nav-item">
                            <a class="nav-link " id="manual-tab" data-toggle="tab" href="#manual" role="tab"
                               aria-controls="manual" aria-selected="true">ثبت دستی</a>
                        </li>
                    </ul>

                    <div class="tab-content p-t-30" id="myTabContent">

                        <div class="tab-pane fade show active" id="qrCode" role="tabpanel" aria-labelledby="qrCode-tab">
                            <div class="row text-center">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-info" onclick="showScan()">
                                        ثبت با اسکنر
                                    </button>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <br>
                                    <div id="scan-input" style="display: none">
                                        <input id="myinputbox" type="text" autofocus style="" class="form-control"
                                               onchange="scan()">
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-12 mt-3">
                                    <h5 id="scan-detail">
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show " id="manual" role="tabpanel" aria-labelledby="manual-tab">
                            <form action="/attendance" method="POST" onsubmit="attendance();return false;">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="">
                                            روز
                                        </label>
                                        <select class="form-control select2" id="day_id" onchange="inquiry()"
                                                name="day_id" dir="rtl">
                                            @foreach($days as $id=>$day)
                                                <option
                                                    value="{{$id}}" {{($id==$today_id) ? 'selected':''}}>{{$day}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">
                                            نام فرد
                                        </label>
                                        <select class="js-example-basic-single form-control select2" id="personnel_id"
                                                onchange="inquiry()"
                                                name="personnel_id" dir="rtl" required>
                                            <option value="">انتخاب کنید</option>
                                            @foreach($personnel as $id=>$person)
                                                <option value="{{$id}}">{{$person}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">
                                            ورود
                                        </label>
                                        <div class="input-group clockpicker-autoclose-demo">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            </div>
                                            <input name="enter" type="text" class="form-control" value="" id="enter"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="">
                                            خروج
                                        </label>
                                        <div class="input-group clockpicker-autoclose-demo">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            </div>
                                            <input name="exit" type="text" class="form-control" value="" id="exit"
                                                   readonly>
                                        </div>
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
        </div>
    </div>
    <div class="row" id="presences">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">افراد امروز
                                <span class="badge badge-success">{{count($todayPersonnel)}} نفر</span>
                            </h5>
                            <a href="/reportUsers/?type={{request()->type}}">
                                <button class="btn btn-info text-white">دریافت فایل</button>
                            </a>
                        </div>
                        <div>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="/">
                                    <button type="button"
                                            class="btn btn-outline-primary {{($type == 'today') ? 'active':''}}"
                                            style="border-top-left-radius: 0; border-bottom-left-radius: 0;"
                                    >امروز
                                    </button>
                                </a>
                                <a href="/?type=presents">
                                    <button type="button"
                                            class="btn btn-outline-primary {{($type == 'presents') ? 'active':''}}"
                                            style="border-top-right-radius: 0; border-bottom-right-radius: 0;"
                                    >حاضر
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>ورود</th>
                                <th>خروج</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($todayPersonnel as $key=>$person)
                                <tr>
                                    <td>{{$key+1}}</td>

                                    <td>
                                        <div>
                                            <h6 class="m-b-0 primary-font">{{$person->personnel->name}}</h6>
                                            <span class="text-muted small">{{$person->roleid}}</span>
                                        </div>
                                    </td>
                                    <td>{{$person->enter}}</td>
                                    <td>{{$person->exit}}</td>
                                    <td><span class="badge {{($person->exit == '') ? 'badge-success':'badge-danger'}}">
                                            {{($person->exit == '') ? 'حاضر':'خروج زده'}}
                                        </span></td>
                                    <td class="">
                                        <div class="dropdown">
                                            <a class="btn btn-outline-primary btn-sm" href="#" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a onclick="modalShow('/attendance/{{$person->id}}/edit');"
                                                   class="dropdown-item">ویرایش</a>
                                                <x-destroy :id="$person ->id" url="'/attendance/delete'"/>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">غایبین
                                <span class="badge badge-warning">{{count($absents)}} نفر</span>
                            </h5>
                            <a href="/reportUsers/?type=absent">
                                <button class="btn btn-info text-white">دریافت فایل</button>
                            </a></div>
                        <div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>مسئول</th>
                                <th>بخش</th>
                                <th>شماره تماس</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($absents as $key=>$absent)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <div>
                                            <h6 class="m-b-0 primary-font">{{$absent->personnel->name}}</h6>
                                        </div>
                                    </td>
                                    <td>{{$absent->personnel->manager!='[]' ? $absent->personnel->manager->name : $absent->personnel->name}}</td>
                                    <td>{{$absent->personnel->section->name}}</td>
                                    <td>{{$absent->personnel->mobile}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('include.modal-show')
@endsection

@section('script')
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        function showScan() {
            if ($('#scan-input').css('display') == 'none') {
                $('#scan-input').show(250);
                $('#myinputbox').focus();
            } else {
                $('#scan-input').hide(250);
            }
        }

        // $('#myinputbox').keypress(function () {
        //     event.preventDefault();
        //     return false;
        // })

        // function setup() {
        // document.getElementById("name1").focus();
        // }

        // window.addEventListener('load', setup, false);

        function scan() {
            $.ajax({
                url: '/scanCheck' + '/' + document.getElementById("myinputbox").value,
                type: "GET",
                success: function (response) {
                    if (response['type'] == 'enter') {
                        audio = new Audio('/enter.mp3');
                        audio.play();
                        swal.fire({
                            title: "ثبت ورود",
                            text: "ورود " + response['name'] + " در ساعت " + response['time'] + " ثبت شد",
                            icon: "success",
                            timer: '3500'
                        });
                        icon = '<button type="button" class="btn btn-success btn-floating ml-4"> <i class="ti-check-box"></i> </button>';
                        $('#scan-detail').html(icon + "آخرین فعالیت : ورود " + response['name'] + " در ساعت " + response['time'] + " ثبت شد.");
                    }


                    if (response['type'] == 'exit') {
                        audio = new Audio('/exit.mp3');
                        audio.play();
                        swal.fire({
                            title: "ثبت خروج",
                            text: "ورود " + response['name'] + " در ساعت " + response['time'] + " ثبت شد",
                            icon: "warning",
                            timer: '3500'
                        })
                        icon = '<button type="button" class="btn btn-warning btn-floating ml-4"> <i class="ti-shift-left-alt"></i> </button>';

                        $('#scan-detail').html(icon + "آخرین فعالیت : خروج " + response['name'] + " در ساعت " + response['time'] + " ثبت شد.");

                    }
                    if (response['type'] == 'duplicate') {
                        audio = new Audio('/error.mp3');
                        audio.play();
                        swal.fire({
                            title: "غیر مجاز",
                            text: "این کارمند امروز یک بار وارد و خارج شده است.",
                            icon: "error",
                            timer: '3500'
                        })
                        icon = '<button type="button" class="btn btn-danger btn-floating ml-4"> <i class="ti-alert"></i> </button>';

                        $('#scan-detail').html(icon + "آخرین فعالیت : خطا - " + response['name'] + " امروز یک بار وارد و خارج شده است.");

                    }
                    if (response['type'] == 'enter-exit') {
                        audio = new Audio('/error.mp3');
                        audio.play();
                        swal.fire({
                            title: "غیر مجاز",
                            text: "فاصله بین ورود و خروج کارمند کمتر از نیم ساعت می باشد.",
                            icon: "error",
                            timer: '3500'
                        })
                        icon = '<button type="button" class="btn btn-danger btn-floating ml-4"> <i class="fa fa-warning"></i> </button>';

                        $('#scan-detail').html(icon + " آخرین فعالیت : خطا - فاصله بین ورود و خروج " + response['name'] + " کمتر از نیم ساعت می باشد." + " در صورت لزوم از ثبت دستی استفاده کنید.");

                    }
                    // window.location.reload(true);
                    document.getElementById('myinputbox').value = '';
                    $("#presences").load(" #presences > *");
                },
                error: function () {
                    audio = new Audio('/error.mp3');
                    audio.play();
                    swal.fire({
                        title: "ناموفق",
                        text: "دوباره اقدام کنید",
                        icon: "warning",
                        timer: '3500'

                    });
                    // window.location.reload(true);
                    document.getElementById('myinputbox').value = ''
                },
            });

        }

        function attendance() {
            day_id = $('#day_id').val();
            personnel_id = $('#personnel_id').val();
            enter = $('#enter').val();
            exit = $('#exit').val();
            url = '/attendance?day_id=' + day_id + '&personnel_id=' + personnel_id + '&enter=' + enter + '&exit=' + exit;
            attendanceAjax(url);
        }

        function attendanceModal() {
            day_id = $('#day_id_mo').val();
            personnel_id = $('#personnel_id_mo').val();
            enter = $('#enter_mo').val();
            exit = $('#exit_mo').val();
            url = '/attendance?day_id=' + day_id + '&personnel_id=' + personnel_id + '&enter=' + enter + '&exit=' + exit;
            attendanceAjax(url);
        }

        function attendanceAjax(url) {
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    if (response == 'success') {
                        swal.fire({
                            title: "ثبت شد",
                            text: "اطلاعات درخواستی ثبت شد",
                            icon: "success",
                            timer: '3500'
                        });
                        $("#presences").load(" #presences > *");
                    } else {
                        swal.fire({
                            title: "خطا !",
                            text: "ساعت خروج بعد از ساعت ورود است !",
                            icon: "warning",
                            timer: '3500'

                        });
                    }
                },
                error: function () {

                    swal.fire({
                        title: "ناموفق",
                        text: "دوباره اقدام کنید",
                        icon: "warning",
                        timer: '3500'

                    });
                },
            });
        }
    </script>
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
    {{--    <script src="https://unpkg.com/html5-qrcode"></script>--}}
    {{--    <script>--}}
    {{--        function docReady(fn) {--}}
    {{--            // see if DOM is already available--}}
    {{--            if (document.readyState === "complete"--}}
    {{--                || document.readyState === "interactive") {--}}
    {{--                // call on next available tick--}}
    {{--                setTimeout(fn, 1);--}}
    {{--            } else {--}}
    {{--                document.addEventListener("DOMContentLoaded", fn);--}}
    {{--            }--}}
    {{--        }--}}

    {{--        docReady(function () {--}}
    {{--            var resultContainer = document.getElementById('qr-reader-results');--}}
    {{--            var lastResult, countResults = 0;--}}

    {{--            function onScanSuccess(decodedText, decodedResult) {--}}
    {{--                if (decodedText !== lastResult) {--}}
    {{--                    ++countResults;--}}
    {{--                    lastResult = decodedText;--}}
    {{--                    // Handle on success condition with the decoded message.--}}
    {{--                    console.log(decodedText);--}}
    {{--                    $.ajax({--}}
    {{--                        url: '/scanCheck' + '/' + decodedText,--}}
    {{--                        type: "GET",--}}
    {{--                        success: function (response) {--}}

    {{--                            if (response == 'enter') {--}}

    {{--                                swal.fire({--}}
    {{--                                    title: "خوش آمدید",--}}
    {{--                                    text: "ورود شما با موفقیت ثبت گردید",--}}
    {{--                                    icon: "success",--}}
    {{--                                    timer: '3500'--}}

    {{--                                });--}}
    {{--                            }--}}


    {{--                            if (response == 'exit') {--}}
    {{--                                swal.fire({--}}
    {{--                                    title: "خوش آمدید",--}}
    {{--                                    text: "خروج شما با موفقیت ثبت گردید",--}}
    {{--                                    icon: "success",--}}
    {{--                                    timer: '3500'--}}
    {{--                                })--}}
    {{--                            }--}}
    {{--                            if (response == 'duplicate') {--}}

    {{--                                swal.fire({--}}
    {{--                                    title: "غیر مجاز",--}}
    {{--                                    text: "امروز یک بار وارد و خارج شده اید.",--}}
    {{--                                    icon: "error",--}}
    {{--                                    timer: '3500'--}}
    {{--                                })--}}
    {{--                            }--}}
    {{--                            if (response == 'enter-exit') {--}}

    {{--                                swal.fire({--}}
    {{--                                    title: "غیر مجاز",--}}
    {{--                                    text: "فاصله بین ورود و خروج شما کمتر از نیم ساعت می باشد.",--}}
    {{--                                    icon: "error",--}}
    {{--                                    timer: '3500'--}}
    {{--                                })--}}
    {{--                            }--}}
    {{--                            // window.location.reload(true);--}}

    {{--                        },--}}
    {{--                        error: function () {--}}

    {{--                            swal.fire({--}}
    {{--                                title: "ناموفق",--}}
    {{--                                text: "دوباره اقدام کنید",--}}
    {{--                                icon: "warning",--}}
    {{--                                timer: '3500'--}}

    {{--                            });--}}
    {{--                            // window.location.reload(true);--}}

    {{--                        },--}}
    {{--                    });--}}

    {{--                    document.getElementById("myText").value = decodedText;--}}


    {{--                }--}}
    {{--            }--}}

    {{--            var html5QrcodeScanner = new Html5QrcodeScanner(--}}
    {{--                "qr-reader", {fps: 10, qrbox: 250});--}}
    {{--            html5QrcodeScanner.render(onScanSuccess);--}}
    {{--        });--}}
    {{--    </script>--}}
    <script src="/assets/vendors/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="/assets/js/examples/clockpicker.js"></script>
    <script src="/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/assets/js/examples/select2.js"></script>
    <script>
        function inquiry() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{url('/attendance/inquiry')}}",
                type: "POST",
                data: {
                    personnel_id: $('#personnel_id').val(),
                    day_id: $('#day_id').val(),
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    if (response !== '') {
                        $('#enter').val(response['enter']);
                        $('#exit').val(response['exit']);
                    } else {
                        $('#enter').val('');
                        $('#exit').val('');
                    }
                }
            });
        }

        $('#modal-show').on('shown.bs.modal', function (e) {
            $('.clockpicker-autoclose-demo').clockpicker({
                autoclose: true,
                align: 'right'
            });
        });
    </script>
@endsection
