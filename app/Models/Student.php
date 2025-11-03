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

    // Filter scope
    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['name'] ?? null, function ($q, $name) {
                $q->where('name', 'like', "%{$name}%");
            })
            ->when($filters['phone'] ?? null, function ($q, $phone) {
                $q->whereHas('user', function ($q2) use ($phone) {
                    $q2->where('phone', 'like', "%{$phone}%");
                });
            })
            ->when($filters['class_id'] ?? null, function ($q, $class_id) {
                $q->where('class_id', $class_id);
            })
            ->when($filters['section_id'] ?? null, function ($q, $section_id) {
                $q->where('section_id', $section_id);
            });
    }
}
