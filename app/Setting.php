<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';


    public  function scopeCategoryTopMenu(){
        return $this->where([ 'type' => 'header_c'])->orderBy('weight', 'desc')->get();
    }
    public function scopeFooterSetting(){
        return $this->where([ 'type' => 'footer_s'])->get();
    }
}
