<?php

namespace App\Repositories;

use App\Exceptions\InvariantError;
use App\Models\Overtime;

interface OvertimeRepositoryInterface
{
    public function store(array $attr);
}

class OvertimeRepository implements OvertimeRepositoryInterface
{
    public function store(array $attr)
    {
        $hasDateEmployes= $this->has_already_overtime($attr['date'], $attr['employee_id']);

        if($hasDateEmployes){
            throw new InvariantError('Employee already has overtime on this date');
        }

        return Overtime::create($attr);
    }

    public function has_already_overtime($date, $employeId){

        return Overtime::where('date', $date)
            ->where('employee_id', $employeId)
            ->exists();
    }
}


;
