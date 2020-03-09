<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
class Admin extends Authenticable
{
    protected $table='admin_table';
    protected $fillable=['name','email','password','image'];
}
