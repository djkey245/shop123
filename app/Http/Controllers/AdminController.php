<?php

namespace App\Http\Controllers;

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


    //function post and ajax request
    public function addCategoryMenuTop(Request $request,Setting $setting){
        $itempost = $request->input();
        //dd($itempost);
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
            $setting->insert(['type' => 'header_c', 'name' => $itempost['name'], 'link' => $itempost['link'], 'weight' => $itempost['weight'] ]);
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
                'year1.digits' => 'Введите начальный год правильно(4f цифры)',
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

}