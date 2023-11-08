<?php

namespace App\AppHumanResources\Attendance\Application;
use App\Http\Controllers\Controller;
use App\AppHumanResources\Attendance\Domain\Attendance;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class AttendanceService extends Controller
{
    protected $responseService;

    public function __construct()
    {
        $this->responseService = new ResponseService();
    }

    public function createAttendanceRecord(Request $request)
    {
   
    $data = [
        'excel_file' => $request->file('excel_file'),
    ];

    $response = Attendance::uploadExcel($data, $this->responseService);

    return $response;

    }

    public function getAttendanceRecords()
    {
        return Attendance::getRecords();
    }

   
}
