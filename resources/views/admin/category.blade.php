@extends('layouts.mainA')


@section('content')
    <div class="container-fluid">
        <div id="alert_info">
            <div id="alert_info_text">

            </div>
            <div class="x-exit">X</div>
        </div>
        <div class="block">
            {{--<div class="caption">HEADER</div>
            <div class="un-caption">Топ-меню - Категории</div>--}}
            <div class="container-fluid">
                <div class="row-fluid" >
                    <div class="span1">ID</div>
                    <div class="span2">Имя</div>
                    <div class="span1"></div>
                    <div class="span2">URL</div>
                    <div class="span1"></div>
                    <div class="span2">ID папы(если вложенная)</div>
                    <div class="span1"></div>
                </div>

            @foreach(\App\Category::all() as $category123)
                @if($category123->papa_id == 0)
                        <div class="row-fluid" >
                            <div class="span1">{{$category123->id}}</div>
                            <div class="span2"><input type="text" value="{{$category123->name}}" id="name_c"></div>
                            <div class="span1"></div>
                            <div class="span2"><input type="text" value="{{$category123->latin_url}}" id="url_c"></div>
                            <div class="span1"></div>
                            <div class="span1"><input type="text" value="{{$category123->papa_id}}" id="papa_c"></div>
                            <div class="span1"></div>
                            <div class="span1 btn-group "><input type="button" onclick="({{$category123->id}})" class="button btn btn-success" value="OK">
                            <input type="button" onclick="({{$category123->id}})" class="button btn btn-danger" value="-"></div>

                        </div>

                        @endif
                @endforeach
                <div class="row-fluid" >
                    <div class="span1">+</div>
                    <div class="span2"><input type="text" value="" id="name_a"></div>
                    <div class="span1"></div>
                    <div class="span2"><input type="text" value="" id="url_a"></div>
                    <div class="span1"></div>
                    <div class="span1"><input type="text" value="" id="papa_a"></div>
                    <div class="span1"></div>
                    <div class="span1 btn-group "><input type="button" onclick="" class="button btn btn-success" value="OK">
                        {{--<input type="button" onclick="" class="button btn btn-danger" value="-">--}}
                    </div>

                </div>

            </div>
        </div>


    </div>
@stop