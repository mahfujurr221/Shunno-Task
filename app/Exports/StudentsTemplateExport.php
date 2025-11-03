<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            ['John Doe', 'john@example.com', '01700000000', 'Dhaka', '2000-01-01', '123456', '10', 'A']
        ];
    }

    public function headings(): array
    {
        return ['name', 'email', 'phone', 'address', 'dob', 'password', 'class', 'section'];
    }
}
