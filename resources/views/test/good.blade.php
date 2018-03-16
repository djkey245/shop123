@extends('layouts.main')

@section('content')

        <p>
            {{$items->name}}
        </p>
        <p>
            {{$items->description}}
        </p>
        <p>
            {{$items->price}} UAH
        </p>
        <br>
        <form action="/order/{{$items->id}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="item_id" value="{{$items->id}}">
            <button class="btn btn-default">Купити</button>
        </form>

@endsection