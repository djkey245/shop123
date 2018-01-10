<?php

namespace App\Http\Controllers;

use App\Category;
use App\Goods;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryAction($name, Category $categories){
        $category = $categories->where('latin_url' , 'LIKE', $name)->firstOrFail();
        if($category){
            $goods = Goods::find(['category_id' => $category->id]);

            return view('goods', ['goods' => $goods]);
        }
    }
}
