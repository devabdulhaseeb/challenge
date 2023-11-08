<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
// use Symfony\Component\HttpFoundation\Response;
use App\Services\JsonResponseService;
use App\Services\ResponseService;
use Illuminate\Support\Facades\Response;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $response;

    /**
     * number of pagination
     * @var int
     */
    protected $pagination;

    /**
     * MainController constructor.
     */
    public function __construct(ResponseService $response)
    {
        $this->response = $response;
      
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
 
}
