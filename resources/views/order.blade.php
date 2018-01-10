@extends('layouts.main')

@section('content')

    <form action="/order_final" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="item_id" value="{{$item_id}}">
        <div>
            <input type="text" name="customer_name" class="form-control">
        </div>
        <div>
            <input type="text" name="phone" class="form-control">
        </div>
        <div>
            <input type="text" name="city" class="form-control">
        </div>
        <div>
            <textarea name="comment" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <div>
            <input type="number" name="amount">
        </div>
        <input type="submit" class="btn btn-default" value="Next">
    </form>

@endsection