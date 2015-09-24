<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $table = 'ministries';

    protected $fillable = [
        'name',
        'description'
    ];
}
