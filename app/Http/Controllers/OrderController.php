<?php

namespace App\Http\Controllers;

use App\Goods;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function buyAction($id){
        $product = Goods::find($id);
        if($product){
            return view('order', ['item_id' => $id]);

        }
    }
    public function finishAction(Request $request){
        $itempost = $request->input();
        dd($itempost);
    }
}
