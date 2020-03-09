<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class News extends Model
{
    protected $table='usertable';
    protected $fillable=['name','DOB','image','Guardian','Contact_no','gender'];


    public function parent(){
        return $this->belongsTo(Parents::class,'Guardian');
    }
}
