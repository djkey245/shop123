<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryS;
use App\Goods;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryAction($name, Category $categories){
        $category = $categories->where('latin_url' , 'LIKE', $name)->firstOrFail();
        if($category){
            $this->data['goods'] = Goods::where('category_id' , 'Like', $category->id)->get();

            return view('goods', $this->data);
        }
    }

    public function categoryActionSub($name, CategoryS $categories){
        $category = $categories->where('link' , 'LIKE', $name)->firstOrFail();
        if($category){
            $this->data['goods'] = Goods::where('categoryS_id' , 'Like', $category->id)->get();

            return view('goods', $this->data);
        }
    }
}
