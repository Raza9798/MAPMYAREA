<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    protected $fillable = [
        "Name",
        "Phone",
        "Lat",
        "Lng",
        "Desc",
    ]; 
}
