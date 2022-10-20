<label>بخش </label>

<select class="js-example-basic-single" multiple dir="rtl" name="section[]">

    @foreach($sections as $section)
        <option
            @if(isset(request()->section) && is_array(request()->section) && in_array($section->id, request()->section)) selected @endif

        value="{{$section->id}}">{{$section->name}}
        </option>
    @endforeach
</select>
