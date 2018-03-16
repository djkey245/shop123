<div class="block">
            <div class="row-fluid">
                <div class="span1">ID</div>
                <div class="span2">Заголовок</div>
                <div class="span1">Цена</div>
                <div class="span1">Ссылка</div>
                <div class="span3">Описание</div>
                <div class="span1">Категория</div>
                <div class="span1">Подкатегория</div>

            </div>
            @foreach(\App\Goods::all() as $good)
                <div class="row-fluid">
                <div class="span1">{{$good->id}}</div>
                <div class="span2"><input type="text" value="{{$good->name}}"></div>
                <div class="span1"><input type="text" value="{{$good->price}}"></div>
                    <div class="span1"><input type="text" value="{{$good->latin_url}}"></div>
                    <div class="span3"><textarea style="width: 100%; height: 150px">{{$good->description}}</textarea></div>
                    <div class="span1"><input type="text" value="{{$good->category_id}}"></div>
                    <div class="span1"><input type="text" value="{{$good->categoryS_id}}"></div>
                </div>

            @endforeach
        </div>