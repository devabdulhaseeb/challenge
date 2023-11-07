<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class AttendanceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
       
        $employeeName = $row['employee_name'];
        $employee = DB::table('employees')->where('name', $employeeName)->first();

        if (!$employee) {
            return null; 
        }

        
        $schedule = DB::table('schedule')->where('employee_id', $employee->id)->first();

        if (!$schedule) {
            return null; 
        }

       
        return [
            'employee_id' => $employee->id,
            'schedule_id' => $schedule->id,
            'check_in' => $row['check_in'],
            'check_out' => $row['check_out'],
        ];
    }
}
