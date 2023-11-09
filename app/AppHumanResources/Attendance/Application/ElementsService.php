<?php

namespace App\AppHumanResources\Attendance\Application;
use App\Http\Controllers\Controller;
use App\Services\ResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class ElementsService extends Controller
{
    
    public function elementFinder(Request $request)
    {
        //use the postman collection for testing.. which is in the root directory of my project
        $rules = [
            'input_value' => 'required|array',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid input. The input_value field must be an array.'], 400);
        }

         $arr = $request->input('input_value', []);

         if (empty($arr)) {
             return response()->json(['error' => 'Input array is empty']);
         }
 
         $elementCounts = [];
 
         $duplicates = [];
 

         foreach ($arr as $element) {
             if (array_key_exists($element, $elementCounts)) {
                 $elementCounts[$element]++;
             } else {
                 $elementCounts[$element] = 1;
             }
             if ($elementCounts[$element] === 2) {
                 $duplicates[] = $element;
             }
         }
 
         return response()->json(['duplicates' => implode(" ",$duplicates)]);
    }


   
}
