<table class="sidebar-table">
    <?php $url = \Illuminate\Support\Facades\URL::current() ;
            $url = explode('/', $url);
    ?>
    @foreach(App\Category::all() as $category)
        @if(empty($url['4']))
            <tr>
                <td  class="category">
                    <a href="/category/{{$category->latin_url}}">{{$category->name}}</a>
                </td>
            </tr>
            @else
                @if($url['4'] == $category->latin_url)
                    <tr>
                        <td  class="category-active">
                            <a href="/category/{{$category->latin_url}}">{{$category->name}}</a>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td  class="category">
                            <a href="/category/{{$category->latin_url}}">{{$category->name}}</a>
                        </td>
                    </tr>
                    @endif
            @endif
    @endforeach
</table>