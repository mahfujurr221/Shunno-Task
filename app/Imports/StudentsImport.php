<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\StudentSection;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public $skipped = []; // To keep track of skipped rows

    public function model(array $row)
    {
        $required = ['name', 'email', 'phone', 'address', 'dob', 'class', 'section'];

        // Skip if required fields are missing
        foreach ($required as $field) {
            if (!isset($row[$field]) || empty($row[$field])) {
                $this->skipped[] = $row + ['reason' => 'Missing required field: ' . $field];
                return null;
            }
        }

        // Skip if student already exists (by email or phone)
        if (User::where('email', $row['email'])->orWhere('phone', $row['phone'])->exists()) {
            $this->skipped[] = $row + ['reason' => 'Duplicate email or phone'];
            return null;
        }

        // Find or create class
        $class = StudentClass::firstOrCreate(['name' => $row['class']]);

        // Find or create section
        $section = StudentSection::firstOrCreate(['name' => $row['section']]);

        // Parse DOB safely
        try {
            $dob = Carbon::parse($row['dob'])->format('Y-m-d');
        } catch (\Exception $e) {
            $this->skipped[] = $row + ['reason' => 'Invalid DOB format'];
            return null;
        }

        // Use default password if missing
        $password = !empty($row['password']) ? $row['password'] : '123456';

        // Create User
        $user = User::create([
            'type' => 'student',
            'fname' => $row['name'],
            'lname' => null,
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make($password),
        ]);

        $user->assignRole('Student');

        // Create Student
        return new Student([
            'user_id' => $user->id,
            'name' => $row['name'],
            'address' => $row['address'],
            'dob' => $dob,
            'class_id' => $class->id,
            'section_id' => $section->id,
            'image' => null,
        ]);
    }
}
