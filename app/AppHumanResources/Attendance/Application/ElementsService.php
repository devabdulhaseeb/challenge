<?php

namespace App\AppHumanResources\Attendance\Application;
use App\Http\Controllers\Controller;
use App\Services\ResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ElementsService extends Controller
{
    protected $responseService;

    public function __construct()
    {
        $this->responseService = new ResponseService();
    }

    public function elementFinder(Request $request)
    {
        $input = $request->input('input_value');

        if (!is_numeric($input)) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $n = (int)$input;
        if ($n < 0) {
            return response()->json(['error' => 'Input should be a non-negative number'], 400);
        }

        $array = range(0, $n - 1);
        $arrayWithDuplicates = array_merge($array, $array); // Duplicate elements in the array

        $duplicates = $this->findDuplicateElements($arrayWithDuplicates);

        return response()->json($duplicates);
    }

    private function findDuplicateElements(array $a)
    {
        $result = [];
        $count = array_count_values($a);

        foreach ($count as $key => $value) {
            if ($value > 1) {
                $result[] = $key;
            }
        }

        return $result;
    }


   
}
