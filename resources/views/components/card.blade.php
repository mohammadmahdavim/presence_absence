<div class="col-3 m-4"
     style="border: double black; height: 450px !important;">
    <img src="/assets/media/image/kanoon.png"
         style="float: left; margin-top: 10px; width: 50px">
    <h5 style="text-align: center; margin-top: 20px;">
        نمایشگاه بین المللی کتاب
        تهران
    </h5>
    <div style="text-align: center; margin-top: 12px">
        مصلی تهران - اردیبهشت 1401
    </div>
    <h1 style="text-align: center;color: black; margin-top: 25px;
                                font-family: b Nazanin !important;font-weight: bolder;font-size: 40px">
        {{$user->name}} <br>
        <span style="margin-top: 20px ">
                                    {{$user->role->name ?? 'کارمند'}}
                                    </span>
    </h1>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4" style="margin-right: -30px">{!! DNS1D::getBarcodeHTML("$user->code", 'C93') !!}</div>
        <div class="col-4"></div>
    </div>
    <h6 style="text-align: center;margin-top: 30px">{{$user->code}}</h6>
</div>
