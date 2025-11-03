<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    // Return all students
    public function collection()
    {
        return Student::with('user', 'class', 'section')->get()->map(function($student) {
            return [
                'name' => $student->name,
                'email' => $student->user->email,
                'phone' => $student->user->phone,
                'address' => $student->address,
                'dob' => $student->dob,
                'class' => $student->class->name ?? '',
                'section' => $student->section->name ?? '',
            ];
        });
    }

    // Set headings
    public function headings(): array
    {
        return ['Name', 'Email', 'Phone', 'Address', 'DOB', 'Class', 'Section'];
    }
}
