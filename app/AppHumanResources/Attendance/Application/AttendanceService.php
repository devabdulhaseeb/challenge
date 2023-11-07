<?php

namespace App\AppHumanResources\Attendance\Application;
use App\Http\Controllers\Controller;
use App\AppHumanResources\Attendance\Domain\Attendance;
use Illuminate\Http\Request;

class AttendanceService extends Controller
{
    public function createAttendanceRecord(Request $request)
    {
        $response = Attendance::uploadExcel($request);
        // return 
    }

    public function getAttendanceRecords()
    {
        return Attendance::all();
    }

    public function updateAttendanceRecord(int $id, array $data)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update($data);

        return $attendance;
    }

    public function deleteAttendanceRecord(int $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
    }

}
