<div class="modal-header">
    <h5 class="modal-title">ویرایش وضعیت حضور <span style="color: red"> {{$presence->personnel->name}} </span>
        در {{$presence->day->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<form action="/attendance" method="POST" onsubmit="attendanceModal();return false;">
    @csrf
    <div class="modal-body">
        <input type="hidden" name="day_id" value="{{$presence->day_id}}" id="day_id_mo">
        <input type="hidden" name="personnel_id" value="{{$presence->personnel_id}}" id="personnel_id_mo">
        <div class="row">
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
                    <input name="enter" type="text" class="form-control" value="{{$presence->enter}}" id="enter_mo"
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
                    <input name="exit" type="text" class="form-control" value="{{$presence->exit}}" id="exit_mo"
                           readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
        </button>
        <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
    </div>
</form>
