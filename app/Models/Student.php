<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function class()
{
    return $this->belongsTo(StudentClass::class, 'class_id');
}

public function section()
{
    return $this->belongsTo(StudentSection::class, 'section_id');
}

}
