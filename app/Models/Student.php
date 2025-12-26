<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentCard;
use illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $table = 'students';
    protected $guarded = [];
    /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject');
    }

}

