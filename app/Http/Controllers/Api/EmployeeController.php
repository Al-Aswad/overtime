<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepository;

    public function __construct(
        EmployeeRepository $employeeRepository
    ) {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(EmployeeRequest $request)
    {
        return ResponseFormatter::success(
            'Setting updated successfully',
            $this->employeeRepository->store($request->validated()),
        );
    }
}
