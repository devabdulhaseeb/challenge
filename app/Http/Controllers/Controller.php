<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
// use Symfony\Component\HttpFoundation\Response;
use App\Services\JsonResponseService;
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
    public function __construct()
    {
        $this->response = new JsonResponseService;
        $requestPerPage = request('per_page', config('app.pagination'));
        app()->setLocale(request('lang') ? request('lang') : 'en');
        $this->pagination = $requestPerPage > 100 ? 100 : $requestPerPage;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    // public function __invoke()
    // {
    //     return $this->response->fail([], 400, Response::HTTP_NOT_FOUND);
    // }

    final protected function sendResponse(array|null|object $data = [], string $message = "", int $code = 200)
    {
        return Response::make([
            "success" => true,
            "message" => $message,
            "data" => $data
        ], $code);
    }

    final protected function sendError(string $message = "", int|string $code = 500)
    {
        return Response::make([
            "success" => false,
            "message" => $message,
        ], $code);
    }
}
