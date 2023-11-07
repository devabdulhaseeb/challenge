<?php

namespace App\AppHumanResources\Attendance\Application;

use App\AppHumanResources\Attendance\Domain\Attendance;

class AttendanceService
{
    public function createAttendanceRecord(array $data)
    {
        return Attendance::create($data);
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
