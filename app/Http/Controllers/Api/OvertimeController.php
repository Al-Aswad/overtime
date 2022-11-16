<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\OvertimeRequest;
use App\Repositories\OvertimeRepository;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    protected $overtimeRepository;

    public function __construct(
        OvertimeRepository $overtimeRepository
    ){
        $this->overtimeRepository = $overtimeRepository;
    }

    public function store(OvertimeRequest $request)
    {
        return ResponseFormatter::success(
            'Setting updated successfully',
            $this->overtimeRepository->store($request->validated()),
        );
    }

    public function overtimeCalculate()
    {
        //
    }
}
