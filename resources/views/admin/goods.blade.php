@extends('layouts.mainA')


@section('content')
    <div class="container-fluid">
        <div class="block" style="display: none;" id="edit-goods" >
            @foreach(\App\Category::all() as $category123)

                <a onclick="$('#category__hide_'+ {{$category123->id}}).toggle() ;">{{$category123->name}}</a>                <br>

                <div class="category__hide" id="category__hide_{{$category123->id}}">
                    @foreach(App\Category::find($category123->id)->categoryS as $categoryS)
                        <div class="row-fluid" >
                            <div class="span1" style="margin-left: 10px"><a onclick="$('#categoryS__hide_'+{{$categoryS->id}}).toggle();">{{$categoryS->name}}</a></div>

                        </div>
                        @foreach(App\Goods::all() as $good)
                            @if($good->categoryS_id == $categoryS->id)
                                <div class="row-fluid category__hide" id="categoryS__hide_{{$categoryS->id}}" style="padding-left: 20px">

                                    <a href="/admin/goods/{{$good->id}}">
                                        <div class="span3">{{$good->name}}</div>
                                        <div class="span3">{{$good->price}}грн.</div>
                                    </a>
                                    <br>
                                </div>
                            @endif
                        @endforeach


                    @endforeach

                </div>




            @endforeach



        </div>
        <button class="btn btn-success" >Добавить товар</button>
        <div class="block" id="add-goods">
            <input type="file" accept="image/*" id="photo" onchange="send_file()">
            <button onclick="test()">6</button>
        </div>
        <script>
            var file;
            var data = new FormData();
            $.each( file, function( key, value ){
                data.append( key, value );
            });
            function send_file() {
                file = this.files;
                $.ajax({
                    type: 'post',
                    url: '/img_temp',
                    data: {
                        "_token": "{{csrf_token()}}",
                        'data': data
                    },
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (msg) {
                        alert(msg);
                    }

                });
            }


        </script>
    </div>

@stop