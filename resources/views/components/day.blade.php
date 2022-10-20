<label>روز </label>

<select  class="js-example-basic-single" multiple dir="rtl" name="day[]">

    @foreach($days as $day)
        <option
            @if(isset(request()->day) && is_array(request()->day) && in_array($day->id, request()->day)) selected @endif
            value="{{$day->id}}">{{$day->name}}
        </option>
    @endforeach
</select>
