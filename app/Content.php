<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = "contents";
    protected $fillable = ["title","synopsis","thumbnail","studio_id"];

    public function studio(){
        return $this->belongsTo('App\Studio','studio_id','id');
    }

}
