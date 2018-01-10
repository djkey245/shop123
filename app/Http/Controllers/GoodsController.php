<?php

namespace App\Http\Controllers;

use App\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function goodInfo($id, Goods $goods){
        $good = $goods->where(['id' => $id])->firstOrFail();
        if($good){
            return view('good', ['items' => $good]);
        }
    }
}
