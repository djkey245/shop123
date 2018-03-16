@extends('layouts.mainA')


@section('content')
    <div class="container-fluid">

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

                </div>

            @foreach(\App\Category::all() as $category123)
                        <div class="row-fluid" >
                            <div class="span1">{{$category123->id}}</div>
                            <div class="span2"><input type="text" value="{{$category123->name}}" id="name_c_{{$category123->id}}"></div>
                            <div class="span1"></div>
                            <div class="span2"><input type="text" value="{{$category123->latin_url}}" id="url_c_{{$category123->id}}"></div>
                            <div class="span1"></div>
                            <div class="span1 btn-group "><input type="button" onclick="editCategoryGoods({{$category123->id}})" class="button btn btn-success" value="OK">
                            <input type="button" onclick="deleteCategoryGoods({{$category123->id}})" class="button btn btn-danger" value="-"></div>

                        </div>

                @endforeach
                <div class="row-fluid" >
                    <div class="span1">+</div>
                    <div class="span2"><input type="text" value="" id="name_a"></div>
                    <div class="span1"></div>
                    <div class="span2"><input type="text" value="" id="url_a"></div>
                    <div class="span1"></div>
                    <div class="span1 btn-group "><input type="button" onclick="addCategoryGoods()" class="button btn btn-success" value="OK">
                        {{--<input type="button" onclick="" class="button btn btn-danger" value="-">--}}
                    </div>

                </div>

            </div>
        </div>
        <div class="block">
        @foreach(\App\Category::all() as $category123)

                <a onclick="$('#category__hide_'+ {{$category123->id}}).toggle() ;">{{$category123->name}}</a>                <br>

                <div class="category__hide" id="category__hide_{{$category123->id}}">
                    @foreach(App\Category::find($category123->id)->categoryS as $categoryS)
                        <div class="row-fluid" >
                            <div class="span1">{{$categoryS->id}}</div>
                            <div class="span2"><input type="text" value="{{$categoryS->name}}" id="name_s_{{$categoryS->id}}"></div>
                            <div class="span1"></div>
                            <div class="span2"><input type="text" value="{{$categoryS->link}}" id="url_s_{{$categoryS->id}}"></div>
                            <div class="span1"></div>
                            <div class="span2"><input type="text" value="{{$categoryS->category_id}}" id="category_s_{{$categoryS->id}}"></div>
                            <div class="span1"></div>
                            <div class="span1 btn-group "><input type="button" onclick="editCategorySGoods({{$categoryS->id}})" class="button btn btn-success" value="OK">
                                <input type="button" onclick="deleteCategorySGoods({{$categoryS->id}})" class="button btn btn-danger" value="-"></div>

                        </div>



                        @endforeach
                        <div class="row-fluid" >
                            <div class="span1">+</div>
                            <div class="span2"><input type="text" value="" id="name_sadd_{{$category123->id}}"></div>
                            <div class="span1"></div>
                            <div class="span2"><input type="text" value="" id="url_sadd_{{$category123->id}}"></div>
                            <div class="span1"></div>
                            <div class="span1 btn-group "><input type="button" onclick="addCategorySGoods({{$category123->id}})" class="button btn btn-success" value="OK">
                                {{--<input type="button" onclick="" class="button btn btn-danger" value="-">--}}
                            </div>

                        </div>
                </div>




            @endforeach
        </div>

    </div>

    <script>
        function addCategoryGoods() {
            var name = document.getElementById('name_a').value;
            var latin_url = document.getElementById('url_a').value;
            $.ajax({
                type: 'POST',
                url: '/admin/category/addCategoryGoods',
                data: {
                    '_token': "{{csrf_token()}}",
                    'name': name,
                    'latin_url': latin_url,
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
            $.ajax({
                type: 'POST',
                url: '/admin/category/editCategoryGoods',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                    'name': name,
                    'latin_url': latin_url,
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

        function editCategorySGoods(id) {
            var name = document.getElementById('name_s_'+id).value;
            var link = document.getElementById('url_s_'+id).value;
            var category = document.getElementById('category_s_'+id).value;
            $.ajax({
                type: 'POST',
                url: '/admin/category/editCategorySGoods',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                    'name': name,
                    'link': link,
                    'category_id': category
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
        function addCategorySGoods(id) {
            var name = document.getElementById('name_sadd_'+id).value;
            var link = document.getElementById('url_sadd_'+id).value;
            $.ajax({
                type: 'POST',
                url: '/admin/category/addCategorySGoods',
                data: {
                    '_token': "{{csrf_token()}}",
                    'name': name,
                    'link': link,
                    'category_id': id
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
        function deleteCategorySGoods(id) {
            $.ajax({
                type: 'POST',
                url: '/admin/category/deleteCategorySGoods',
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