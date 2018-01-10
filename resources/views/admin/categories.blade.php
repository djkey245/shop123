<?php $url = \Illuminate\Support\Facades\URL::current() ;
$url = explode('/', $url);
$categories = ['0' => ['link' => 'active', 'name' => 'Главные настройки'],
                    '1' => ['link' => 'category', 'name' => 'Категории товаров'],
                    '2' => ['link' => 'goods', 'name' => 'Товары'],
                    '3' => ['link' => 'index_page', 'name' => 'Главная страница '],
                    '4' => ['link' => 'about', 'name' => 'О нас'],
                    '5' => ['link' => 'oplata', 'name' => 'Оплата и доставка'],
                    '6' => ['link' => 'cab', 'name' => 'Личный кабинет'],
                    '7' => ['link' => 'news', 'name' => 'Новости'],
                    '8' => ['link' => 'other', 'name' => 'Дополнительные страницы']
];
?>

<table class="sidebar-table">
    @foreach($categories as $category)
        @if(empty($url['4']))
            <tr>
                <td class="category">
                    <a href="/admin/{{$category['link']}}">{{$category['name']}}</a>
                </td>
            </tr>
        @else
            @if($url['4'] == $category['link'])
                <tr>
                    <td class="category-active">
                        <a href="/admin/{{$category['link']}}">{{$category['name']}}</a>
                    </td>
                </tr>
            @else
                <tr>
                    <td class="category">
                        <a href="/admin/{{$category['link']}}">{{$category['name']}}</a>
                    </td>
                </tr>
            @endif
        @endif
    @endforeach
    {{--<tr>
        <td class="category">
            <a href="/admin/category">Категории товаров</a>
        </td>
    </tr>
    <tr>
        <td class="category">
            <a href="/admin/goods">Товары</a>
        </td>
    </tr>
    <tr>
        <td class="category">
            <a href="/admin/about">О нас</a>
        </td>
    </tr>
    <tr>
        <td class="category">
            <a href="/admin/oplata">Оплата и доставка</a>
        </td>
    </tr>
    <tr>
        <td class="category">
            <a href="/admin/news">Новости</a>
        </td>
    </tr>--}}
</table>