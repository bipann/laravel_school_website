<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
class Parents extends Authenticable


{
    protected $table='parent_table';
    protected $fillable=['name','email','Contact_no','Address','password','image','role'];

    public function childrens(){
        return $this->hasMany(News::class, 'Guardian','id');
    }
}
