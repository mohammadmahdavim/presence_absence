@extends('layouts.main')

@section('head')
    <link rel="stylesheet" href="/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h3>
                لیست پرسنل
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
                            لیست کل پرسنل در نمایشگاه کتاب
                        </h5>
                    </div>
                    <table id="personnel-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>کد ملی</th>
                            <th>موبایل</th>
                            <th>نقش</th>
                            <th>بخش</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($personnel as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->national_code}}</td>
                                <td>{{$row->mobile}}</td>
                                <td>{{$row->role->name}}</td>
                                <td>{{$row->section->name}}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-outline-primary btn-sm" href="#" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="/personnel/{{$row->id}}/edit" class="dropdown-item">ویرایش</a>
                                            <x-destroy :id="$row->id" url="'/personnel/destroy'"/>

                                            <a href="/personnel/cart/{{$row->id}}" class="dropdown-item">کارت</a>
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
@endsection

@section('script')
    <script src="/js/sweet.js"></script>

    @include('sweetalert::alert')
    <!-- begin::dataTable -->
    <script src="/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->
    <script>
        $('#personnel-table').DataTable({
            responsive: true,
            language: {
                "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
                "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                "sInfoPostFix": "",
                "sInfoThousands": ",",
                "sLengthMenu": "نمایش _MENU_ رکورد",
                "sLoadingRecords": "در حال بارگزاری...",
                "sProcessing": "در حال پردازش...",
                "sSearch": "جستجو:",
                "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
                "oPaginate": {
                    "sFirst": "ابتدا",
                    "sLast": "انتها",
                    "sNext": "بعدی",
                    "sPrevious": "قبلی"
                },
                "oAria": {
                    "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                    "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                }
            }
        });
    </script>
@endsection
