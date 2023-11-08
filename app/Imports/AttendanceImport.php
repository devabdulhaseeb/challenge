<?php
namespace App\Imports;

use App\AppHumanResources\Attendance\Domain\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class AttendanceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
{
    // dd($row);
    $employeeId = $row['id'];
    $employee = DB::table('employee')->where('id', $employeeId)->first();

    if (!$employee) {
        return null; 
    }

    $schedule = DB::table('schedule')->where('employee_id', $employee->id)->first();

    if (!$schedule) {
        return null; 
    }

    
    // return new Attendance([
    //     'employee_id' => $employee->id,
    //     'schedule_id' => $schedule->id,
    //     'check_in' => $row['checkin'],
    //     'check_out' => $row['checkout'],
    // ]);

    $attendanceData = [
        'employee_id' => $employee->id,
        'schedule_id' => $schedule->id, 
        'check_in' => $row['checkin'],
        'check_out' => $row['checkout'],
    ];

   
    Attendance::updateOrInsert(
        ['employee_id' => $attendanceData['employee_id']],
        $attendanceData
    );

    return null;
}

}
