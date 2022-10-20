<label>غرفه </label>

<select  class="js-example-basic-single" multiple dir="rtl" name="loge[]">

    @foreach($loges as $loge)
        <option
            @if(isset(request()->loge) && is_array(request()->loge) && in_array($loge->id, request()->loge)) selected @endif

        value="{{$loge->id}}">{{$loge->name}}
        </option>
    @endforeach
</select>
