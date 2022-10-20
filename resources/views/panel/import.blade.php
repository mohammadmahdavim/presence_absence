@extends('layouts.main')

@section('content')
    <div class="page-header">
        <div>
            <h3>داشبورد</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">پیش فرض</li>
                </ol>
            </nav>
        </div>
    </div>
    <h3>مدیران</h3>

    <div class="row">
        <form action="/manager-import" method="post" enctype="multipart/form-data">
            @csrf
            <input name="import_file" type="file" required>
            <button class="btn btn-success btn-block">ارسال</button>
        </form>
    </div>
    <br>
    <hr>
    <br>
    <h3>کارمندان</h3>
    <div class="row">
        <form action="/personnel-import" method="post" enctype="multipart/form-data">
            @csrf
            <input name="import_file" type="file" required>
            <button class="btn btn-success btn-block">ارسال</button>
        </form>
    </div>
@endsection
