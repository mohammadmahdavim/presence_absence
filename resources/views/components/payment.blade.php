<label>مالی </label>

<select class="js-example-basic-single" multiple dir="rtl" name="payment[]">

    @foreach($payments as $payment)
        <option
            @if(isset(request()->payment) && is_array(request()->payment) && in_array($payment->id, request()->payment)) selected @endif

        value="{{$payment->id}}">{{$payment->name}}
        </option>
    @endforeach
</select>
