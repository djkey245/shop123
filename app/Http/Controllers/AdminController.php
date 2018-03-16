<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryS;
use App\Setting;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller
{
    //page
    public function index(){
        return view('admin.index');
    }
    public function category(){
        return view('admin.category');
    }

    public function goods(){
        return view('admin.goods');
    }

//////////////////////////////////////////////
    /// settings!!!!

    //function post and ajax request
    public function addCategoryMenuTop(Request $request,Setting $setting){
        $itempost = $request->input();
        //dd($itempost);
        $itempost += ['updated_at' => date("Y-m-j H:i:s")];
        unset($itempost['_token']);
        $categoryTop = Validator::make($itempost, [
            'name' => 'required|string|min:3|max:25',
            'link' => 'required|string|min:3|max:25',
            'weight' => 'required|numeric'
        ]
            ,[
                'name.required' => 'Введите имя',
                'name.string' => 'Поле имя: должно быть строкою',
                'name.min' => 'Короткое имя',
                'name.max' => 'Большое имя',
                'link.required' => 'Введите ссылку',
                'link.string' => 'Поле ссылка: должно быть строкою',
                'link.min' => 'Короткая ссылка',
                'link.max' => 'Большая ссылка',
                'weight.required' => 'Введите номер позиции',
                'weight.numeric' => 'Поле номер позиции: должно быть числом'


            ]);
        if($categoryTop->fails()){
            return json_encode($categoryTop->errors()->getMessages());
            //$errors = $categoryTop->messages()->toJson();
        }
        else{
            $setting->insert(['type' => 'header_c', 'name' => $itempost['name'], 'link' => $itempost['link'], 'weight' => $itempost['weight'], 'updated_at' => date("Y-m-j H:i:s") ]);
            return 'true';
        }

        //return response()->json([ "errors" => $errors ]);



        /*$this->validate($request,[
            'name' => 'required|min:3|max:25',
            'link' => 'required|min:3|max:25',
            'weight' => 'required|numeric'
        ]);*/
        /*
            ,[
            'name.required' => 'Введите имя',
            'name.min' => 'Короткое имя',
            'name.max' => 'Большое имя',
            'link.required' => 'Введите ссылку',
            'link.min' => 'Короткая ссылка',
            'link.max' => 'Большая ссылка',
            'weight.required' => 'Введите номер позицыи',
            'weight.numeric' => 'Должно быть число'
        ]*/

    }
    public function deleteCategoryMenuTop(Request $request, Setting $setting){
        $itempost = $request->input();
        if($setting->where(['id' => $itempost['id']])->delete()){
            return 'true';
        }
        else{
            return 'false';
        }
    }
    public function editCategoryMenuTop(Request $request, Setting $setting){
        $itempost = $request->input();
        //dd($itempost);
        $id = $itempost['id'];
        unset($itempost['_token']);
        unset($itempost['id']);
        $categoryTop = Validator::make($itempost, [
                'name' => 'required|string|min:3|max:25',
                'link' => 'required|string|min:3|max:25',
                'weight' => 'required|numeric'
            ]
            ,[
                'name.required' => 'Введите имя',
                'name.string' => 'Поле имя: должно быть строкою',
                'name.min' => 'Короткое имя',
                'name.max' => 'Большое имя',
                'link.required' => 'Введите ссылку',
                'link.string' => 'Поле ссылка: должно быть строкою',
                'link.min' => 'Короткая ссылка',
                'link.max' => 'Большая ссылка',
                'weight.required' => 'Введите номер позиции',
                'weight.numeric' => 'Поле номер позиции: должно быть числом'


            ]);
        if($categoryTop->fails()){
            return json_encode($categoryTop->errors()->getMessages());
            //$errors = $categoryTop->messages()->toJson();
        }
        else{
            $itempost += ['updated_at' => date("Y-m-j H:i:s")];
            $itempost['type'] = 'header_c';
            if($setting->where(['id' => $id])->update($itempost)){

                return 'true';
            }
            else{
                return 'false';
            }
        }
    }

    public function editFooterSetting(Request $request, Setting $setting){
        $itempost = $request->input();
        unset($itempost['_token']);
        $footerValid = Validator::make($itempost, [
                'name' => 'required|string|min:3|max:25',
                'year1' => 'required|numeric|digits:4',
                'year2' => 'required|numeric|digits:4'
            ]
            ,[
                'name.required' => 'Введите имя компании',
                'name.string' => 'Поле имя: должно быть строкою',
                'name.min' => 'Короткое имя компании',
                'name.max' => 'Большое имя компании',
                'year1.required' => 'Введите начальный год',
                'year1.numeric' => 'Поле начальный год должно быть числом',
                'year1.digits' => 'Введите начальный год правильно(4 цифры)',
                'year2.required' => 'Введите последний год',
                'year2.numeric' => 'Поле последний год должно быть числом',
                'year2.digits' => 'Введите последний год правильно(4 цифры)',


            ]);
        if($footerValid->fails()){
            return json_encode($footerValid->errors()->getMessages());
            //$errors = $categoryTop->messages()->toJson();
        }
        else{
            //$itempost += ['updated_at' => date("Y-m-j H:i:s")];
            if($setting){
                $setting->where(['link' => 'company_name'])->update(['name' => $itempost['name']]);
                $setting->where(['link' => 'company_year1'])->update(['name' => $itempost['year1']]);
                $setting->where(['link' => 'company_year2'])->update(['name' => $itempost['year2']]);

                        return 'true';



            }
            else{
                return 'false';
            }
        }
    }

    //////////////////////////////////////////////
    /// category!!!!


    public function addCategoryGoods(Request $request, Category $category){
        $itempost = $request->input();
        $itempost += ['updated_at' => date("Y-m-j H:i:s")];

        unset($itempost['_token']);
        $Valid = Validator::make($itempost, [
                'name' => 'required|string|min:2|max:25',
                'latin_url' => 'required|alpha_dash|min:3',

            ]
            ,[
                'name.required' => 'Введите имя категории',
                'name.string' => 'Поле имя категории: должно быть строкою',
                'name.min' => 'Короткое имя категории',
                'name.max' => 'Большое имя категории',
                'latin_url.required' => 'Введите ссылку на категорию',
                'latin_url.alpha_dash' => 'Поле должно содержать только латинские символы, цифры, знаки подчёркивания (_) и дефисы (-).',
                'latin_url.min' => 'Длина ссылка должна быть больше 2х символов',



            ]);
        if($Valid->fails()){
            return json_encode($Valid->errors()->getMessages());
            //$errors = $categoryTop->messages()->toJson();
        }
        else{
            if($category->insert($itempost)){
                return 'true';
            }
            else{
                return 'false';
            }
        }
    }
    public function editCategoryGoods(Request $request, Category $category){
        $itempost = $request->input();
        $id = $itempost['id'];
        unset($itempost['_token']);
        unset($itempost['id']);

        $Valid = Validator::make($itempost, [
                'name' => 'required|string|min:2|max:25',
                'latin_url' => 'required|alpha_dash|min:3',

            ]
            ,[
                'name.required' => 'Введите имя категории',
                'name.string' => 'Поле имя категории: должно быть строкою',
                'name.min' => 'Короткое имя категории',
                'name.max' => 'Большое имя категории',
                'latin_url.required' => 'Введите ссылку на категорию',
                'latin_url.alpha_dash' => 'Поле должно содержать только латинские символы, цифры, знаки подчёркивания (_) и дефисы (-).',
                'latin_url.min' => 'Длина ссылка должна быть больше 2х символов',



            ]);
        if($Valid->fails()){
            return json_encode($Valid->errors()->getMessages());
            //$errors = $categoryTop->messages()->toJson();
        }
        else{
            $itempost += ['updated_at' => date("Y-m-j H:i:s")];
            if($category->where(['id' => $id])->update($itempost)){
                return 'true';
            }
            else{
                return 'false';
            }
        }
    }
    public function deleteCategoryGoods(Request $request, Category $category){
        $itempost = $request->input();
        if($category->where(['id' => $itempost['id']])->delete()){
            return 'true';
        }
        else{
            return 'false';
        }
    }

    /////////////////////////////////////////////////////////////////////////
    /// /////////////CATEGORYS
    ///

    public function editCategorySGoods(Request $request, CategoryS $categoryS){
        $itempost = $request->input();
        $id = $itempost['id'];
        unset($itempost['_token']);
        unset($itempost['id']);

        $Valid = Validator::make($itempost, [
                'name' => 'required|string|min:2|max:25',
                'link' => 'required|alpha_dash|min:3',
                'category_id' => 'required|numeric'
            ]
            ,[
                'name.required' => 'Введите имя категории',
                'name.string' => 'Поле имя категории: должно быть строкою',
                'name.min' => 'Короткое имя категории',
                'name.max' => 'Большое имя категории',
                'latin_url.required' => 'Введите ссылку на категорию',
                'latin_url.alpha_dash' => 'Поле должно содержать только латинские символы, цифры, знаки подчёркивания (_) и дефисы (-).',
                'latin_url.min' => 'Длина ссылка должна быть больше 2х символов',
                'category_id.required' => 'Введите id родительской категории',
                'category_id.numeric' => 'Должно быть число',




            ]);
        if($Valid->fails()){
            return json_encode($Valid->errors()->getMessages());
            //$errors = $categoryTop->messages()->toJson();
        }
        else{
            $itempost += ['updated_at' => date("Y-m-j H:i:s")];
            if($categoryS->where(['id' => $id])->update($itempost)){
                return 'true';
            }
            else{
                return 'false';
            }
        }
    }
    public function addCategorySGoods(Request $request, CategoryS $categoryS){
        $itempost = $request->input();
        $itempost += ['updated_at' => date("Y-m-j H:i:s")];

        unset($itempost['_token']);
        $Valid = Validator::make($itempost, [
                'name' => 'required|string|min:2|max:25',
                'link' => 'required|alpha_dash|min:3',
                'category_id' => 'required|numeric'
            ]
            ,[
                'name.required' => 'Введите имя категории',
                'name.string' => 'Поле имя категории: должно быть строкою',
                'name.min' => 'Короткое имя категории',
                'name.max' => 'Большое имя категории',
                'latin_url.required' => 'Введите ссылку на категорию',
                'latin_url.alpha_dash' => 'Поле должно содержать только латинские символы, цифры, знаки подчёркивания (_) и дефисы (-).',
                'latin_url.min' => 'Длина ссылка должна быть больше 2х символов',
                'category_id.required' => 'Введите id родительской категории',
                'category_id.numeric' => 'Должно быть число',




            ]);
        if($Valid->fails()){
            return json_encode($Valid->errors()->getMessages());
            //$errors = $categoryTop->messages()->toJson();
        }
        else{
            if($categoryS->insert($itempost)){
                return 'true';
            }
            else{
                return 'false';
            }
        }
    }
    public function deleteCategorySGoods(Request $request, CategoryS $categoryS){
        $itempost = $request->input();
        if($categoryS->where(['id' => $itempost['id']])->delete()){
            return 'true';
        }
        else{
            return 'false';
        }
    }
}
