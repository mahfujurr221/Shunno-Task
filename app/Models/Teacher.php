<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
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
            ->when($filters['subject_id'] ?? null, function ($q, $subject_id) {
                $q->where('subject_id', $subject_id);
            });
    }
}
