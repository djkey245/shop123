<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function categoryTopMenu(Setting $setting){
        $category = $setting->where(['type' => 'header_c']);

        return $category;
    }
    protected function formatValidationErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
