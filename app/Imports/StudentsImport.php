<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\StudentSection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $required = ['first_name', 'email', 'phone', 'address', 'dob', 'class', 'section'];
        foreach ($required as $field) {
            if (!isset($row[$field]) || empty($row[$field])) {
                return null;
            }
        }

        // Find class and section
        $class = StudentClass::where('name', $row['class'])->first();
        $section = StudentSection::where('name', $row['section'])->first();

        if(!$class || !$section) {
            return null; 
        }

        $user = User::create([
            'type' => 'student',
            'fname' => $row['first_name'],
            'lname' => $row['last_name'] ?? null,
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make('123456'), 
        ]);
        $user->assignRole('Student');

        return new Student([
            'user_id' => $user->id,
            'name' => trim($row['first_name'].' '.$row['last_name']),
            'address' => $row['address'],
            'dob' => $row['dob'],
            'class_id' => $class->id,
            'section_id' => $section->id,
            'image' => null
        ]);
    }
}
