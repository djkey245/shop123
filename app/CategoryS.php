<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryS extends Model
{
    protected $table = "category_s";
    protected $id;
    public function scopeIdGet($id){
        return $this->where(['papa_id' => $id])->get();
    }


}
