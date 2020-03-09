<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='usertable';
    protected $fillable=['name','email','password','image'];
}
