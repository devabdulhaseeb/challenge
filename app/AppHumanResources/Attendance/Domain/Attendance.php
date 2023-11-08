<?php

namespace App\AppHumanResources\Attendance\Domain;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;
use App\Services\ResponseService;
use Illuminate\Support\Facades\Validator;
use DB;
class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $guarded = ['created_at','updated_at'];

    public static function uploadExcel($data, ResponseService $responseService)
    {
        // dd($data->all());
        $validator = Validator::make($data, [
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return $responseService->sendError($validator->errors()->first(), 400);
        }
        
        $file = $data['excel_file'];

        if (!$file) {
            return $responseService->sendError('Something Went Wrong, Please Retry', 500);
        }

        $import = new AttendanceImport;
        $data = Excel::import($import, $file);
        // dd($data);
        return $responseService->sendResponse(null, 'Data Imported', 200);
    }

    public static function getRecords()
    {
        $responseService = new ResponseService ();
        $records = self::select([
            'employee.name AS name',
            'attendance.check_in AS checkin',
            'attendance.check_out AS checkout',
            DB::raw('TIMEDIFF(attendance.check_out, attendance.check_in) AS hours')
        ])
        ->join('employee', 'attendance.employee_id', '=', 'employee.id')
        ->get();
            // dd($records);
        if(!$records->isNotEmpty()) return $responseService->sendError('No Data Available', 500);
        return $responseService->sendResponse($records, 'Attendance Retrieved', 200);
    }
    

}
