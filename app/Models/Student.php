<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentCard;
use illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $table = 'students';
    protected $guarded = [];

}

