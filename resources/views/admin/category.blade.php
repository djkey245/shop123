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
                            <div class="span2"><input type="text" value="{{$category123->name}}" id="name_c_{{$category123->id}}"></div>
                            <div class="span1"></div>
                            <div class="span2"><input type="text" value="{{$category123->latin_url}}" id="url_c_{{$category123->id}}"></div>
                            <div class="span1"></div>
                            <div class="span1"><input type="text" value="{{$category123->papa_id}}" id="papa_c_{{$category123->id}}"></div>
                            <div class="span1"></div>
                            <div class="span1 btn-group "><input type="button" onclick="editCategoryGoods({{$category123->id}})" class="button btn btn-success" value="OK">
                            <input type="button" onclick="deleteCategoryGoods({{$category123->id}})" class="button btn btn-danger" value="-"></div>

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
                    <div class="span1 btn-group "><input type="button" onclick="addCategoryGoods()" class="button btn btn-success" value="OK">
                        {{--<input type="button" onclick="" class="button btn btn-danger" value="-">--}}
                    </div>

                </div>

            </div>
        </div>


    </div>

    <script>
        function addCategoryGoods() {
            var name = document.getElementById('name_a').value;
            var latin_url = document.getElementById('url_a').value;
            var papa_id = document.getElementById('papa_a').value;
            $.ajax({
                type: 'POST',
                url: '/admin/category/addCategoryGoods',
                data: {
                    '_token': "{{csrf_token()}}",
                    'name': name,
                    'latin_url': latin_url,
                    'papa_id': papa_id
                },
                success: function (msg) {
                    if(msg){
                        if(msg == 'true'){
                            $('#alert_info').show();
                            $('#alert_info_text').text('Сохранено!');
                            location.reload(true);
                        }
                        else{
                            var errors = JSON.parse(msg);
                            var error = [];
                            for(var x in errors){
                                error.push(errors[x]);
                            }
                            $('#alert_info').show();
                            $('#alert_info_text').text(error[0]);
                        }

                    }
                    else{
                        $('#alert_info').hide();

                    }
                    //$("#alert_info").value = errors;
                    //location.reload(true);
                }
            });
        }
        function editCategoryGoods(id) {
            var name = document.getElementById('name_c_'+id).value;
            var latin_url = document.getElementById('url_c_'+id).value;
            var papa_id = document.getElementById('papa_c_'+id).value;
            $.ajax({
                type: 'POST',
                url: '/admin/category/editCategoryGoods',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                    'name': name,
                    'latin_url': latin_url,
                    'papa_id': papa_id
                },
                success: function (msg) {
                    if(msg){
                        if(msg == 'true'){
                            $('#alert_info').show();
                            $('#alert_info_text').text('Сохранено!');
                            location.reload(true);
                        }
                        else{
                            var errors = JSON.parse(msg);
                            var error = [];
                            for(var x in errors){
                                error.push(errors[x]);
                            }
                            $('#alert_info').show();
                            $('#alert_info_text').text(error[0]);
                        }

                    }
                    else{
                        $('#alert_info').hide();

                    }
                    //$("#alert_info").value = errors;
                    //location.reload(true);
                }
            });
        }
        function deleteCategoryGoods(id) {
            $.ajax({
                type: 'POST',
                url: '/admin/category/deleteCategoryGoods',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id
                },

                success: function(msg){
                    if(msg == 'true'){
                        location.reload(true);
                    }
                    else {
                        $('#alert_info').show();
                        $('#alert_info_text').text("Ошыбка!!!");
                    }

                }

            });
        }
    </script>
@stop