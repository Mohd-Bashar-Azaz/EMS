<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    public function datas()
{
    return $this->hasOne(Datas::class);
}
}
