<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigPrice extends Model
{
    //
    protected $table = 'config_prices';
    protected $fillable = ['status', 'user_id','config_price'];
}
