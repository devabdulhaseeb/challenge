<?php

namespace App\AppHumanResources\Attendance\Domain;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport; 

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $guarded = ['created_at','updated_at'];

    public static function uploadExcel($data)
    {
        
        $file = $data->file('excel_file');

        if (!$file) {
            return (new Controller)->sendError('Some Thing Went Wrong, Please Retry',500);
            
        }

       
        $import = new AttendanceImport;
        $data =  Excel::import($import, $file);

        return (new Controller)->sendResponse($data,'Data Imported',200);
    }
}
