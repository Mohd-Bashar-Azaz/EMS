<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Datas extends Model

{

    public function employee()
{
    return $this->belongsTo(Employee::class);
}
    public $timestamps = true;
}
