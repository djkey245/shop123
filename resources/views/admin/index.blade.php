@extends('layouts.mainA')


@section('content')
    <div class="container-fluid">
        <div id="alert_info">
            <div id="alert_info_text">

            </div>
            <div class="x-exit">X</div>
        </div>
        <div class="block">
            <div class="caption">HEADER</div>
            <div class="un-caption">Топ-меню - Категории</div>
            <table class="un-table table-responsive row-fluid">
                <tr>
                    <td>Имя</td>
                    <td>Ссылка</td>
                    <td>Порядок(от большего)</td>
                </tr>
                @foreach(App\Setting::categoryTopMenu() as $categoryTopMenu)
                    <tr>
                        <td><input type="text" id="addCategoryTopMenuName_{{$categoryTopMenu->id}}" value="{{$categoryTopMenu->name}}" ></td>
                        <td><input type="text" id="addCategoryTopMenuLink_{{$categoryTopMenu->id}}" value="{{$categoryTopMenu->link}}" ></td>
                        <td><input type="number" id="addCategoryTopMenuWeight_{{$categoryTopMenu->id}}" value="{{$categoryTopMenu->weight}}" ></td>
                        <td><button type="button"  class="btn btn-success" onclick="editCategoryTopMenu({{$categoryTopMenu->id}})" style="margin-bottom: 10px">OK</button>
                            <button type="button"  class="btn btn-danger " onclick="deleteCategoryTopMenu({{$categoryTopMenu->id}})" style="margin-bottom: 10px">-</button>
                        </td>

                    </tr>
                @endforeach
                <tr>
                    <td><input type="text" value="" id="addCategoryTopMenuName" class="form-control"></td>
                    <td><input type="text" value="" id="addCategoryTopMenuLink" class="form-control"></td>
                    <td><input type="number" value="" id="addCategoryTopMenuWeight" class="form-control"></td>
                    <td><button type="button" onclick="addCategoryTopMenu()" class="btn btn-success" style="margin-bottom: 10px">+</button></td>
                </tr>
            </table>
            <hr>
            {{--////////////////////////////////////--}}

        </div>
        <div class="block">
            <div class="caption">CONTENT</div>

        </div>
        <div class="block">
            <div class="caption">FOOTER</div>
            <div class="un-caption">Компания</div>

            <div class="container-fluid">
                <div class="row-fluid" >
                    <div class="span3">Имя</div>
                    <div class="span3">С .... года</div>
                    <div class="span3">По .... год</div>
                </div>
                <div class="row-fluid" >
                    @foreach(App\Setting::footerSetting() as $footerSetting)

                        <div class="span3"><input type="text" value="{{$footerSetting->name}}" id="{{$footerSetting->link}}"></div>
                    @endforeach
                    <div class="span3"><input type="button" onclick="editFooterSetting()" class="button btn btn-success" value="OK"></div>

                </div>
            </div>
        </div>

    </div>
    <script>
        function addCategoryTopMenu() {
            var name = document.getElementById('addCategoryTopMenuName').value;
            var weight = document.getElementById('addCategoryTopMenuWeight').value;
            var link = document.getElementById('addCategoryTopMenuLink').value;
            $.ajax({
                type: 'POST',
                url: '/admin/active/addCategoryMenuTop',
                data: {
                    '_token': "{{csrf_token()}}",
                    'name': name,
                    'link': link,
                    'weight': weight
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
        function editCategoryTopMenu(id) {
            var name = document.getElementById('addCategoryTopMenuName_'+id).value;
            var weight = document.getElementById('addCategoryTopMenuWeight_'+id).value;
            var link = document.getElementById('addCategoryTopMenuLink_'+id).value;
            $.ajax({
                type: 'POST',
                url: '/admin/active/editCategoryMenuTop',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                    'name': name,
                    'link': link,
                    'weight': weight
                },
                success: function (msg) {
                    if(msg){
                        if(msg == 'true'){
                            $('#alert_info').show();
                            $('#alert_info_text').text('Сохранено!');
                            location.reload(true);
                        }
                        if(msg == 'false'){
                            $('#alert_info').show();
                            $('#alert_info_text').text("Ошыбка!!!");
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
        function deleteCategoryTopMenu(id) {
            $.ajax({
                type: 'POST',
                url: '/admin/active/deleteCategoryMenuTop',
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
        function editFooterSetting() {
            var name = document.getElementById('company_name').value;
            var year1 = document.getElementById('company_year1').value;
            var year2 = document.getElementById('company_year2').value;
            $.ajax({
                type: 'POST',
                url: '/admin/active/editFooterSetting',
                data: {
                    '_token': "{{csrf_token()}}",
                    'name': name,
                    'year1': year1,
                    'year2': year2
                },
                success: function (msg) {
                    if(msg){
                        if(msg == 'true'){
                            $('#alert_info').show();
                            $('#alert_info_text').text('Сохранено!');
                            location.reload(true);
                        }
                        if(msg == 'false'){
                            $('#alert_info').show();
                            $('#alert_info_text').text("Ошыбка!!!");
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






        function test() {
            $.ajax({
                type: 'POST',
                url: '/',
                data: {

                },

                success: function(errors){

                    //$('#alert_info').value = errors;

                    alert(errors);
                }

            });
        }
        
        
        
        
    </script>

@stop