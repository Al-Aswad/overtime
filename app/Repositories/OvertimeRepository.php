<?php

namespace App\Repositories;

use App\Exceptions\InvariantError;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\Setting;
use Carbon\Carbon;

interface OvertimeRepositoryInterface
{
    public function store(array $attr);

    public function overtimeCalculate($date);
}

class OvertimeRepository implements OvertimeRepositoryInterface
{
    public function store(array $attr)
    {
        $hasDateEmployes = $this->has_already_overtime($attr['date'], $attr['employee_id']);

        if ($hasDateEmployes) {
            throw new InvariantError('Employee already has overtime on this date');
        }

        return Overtime::create($attr);
    }

    public function overtimeCalculate($date)
    {
        $method = Setting::with('referrence')
            ->first();

        // return $method->referrence->expression;

        $employees = Employee::with([
            'overtimes' => function ($query) use ($date) {
                $query->whereMonth('date', Carbon::parse($date)->month)
                    ->whereYear('date', Carbon::parse($date)->year);
            }
        ])->get();

        //sum overtime every employee
        $employees = $employees->map(function ($employee) {

            $employee->overtimes->map(function ($employe) {
                $employe->overtime_duration = Carbon::parse($employe->time_started)->diffInMinutes(Carbon::parse($employe->time_ended));
            });

            // overtime total
            $employee->overtime_duration = $employee->overtimes->sum('overtime_duration');

            return $employee;
        });

        // rounding overtime
        $employees = $employees->map(function ($employee) use ($method) {
            $employee->overtime_duration = $this->rounding($employee->overtime_duration);

            return $employee;
        });

        // (salary / 173) * overtime_duration_total
        // calculate overtime pay amount
        $employees = $employees->map(function ($employee) use ($method) {
            $employee->amount = $this->calculate_overtime_pay_amount($employee->overtime_duration, $employee->salary, $method->referrence->id);

            return $employee;
        });

        return $employees;
    }

    public function has_already_overtime($date, $employeId)
    {

        return Overtime::where('date', $date)
            ->where('employee_id', $employeId)
            ->exists();
    }

    protected function rounding($overtime)
    {
        // mod 60
        $mod =  $overtime % 60;

        if ($mod <= 45) {
            return floor($overtime / 60);
        }

        return round($overtime / 60, 0) + 1;
    }

    protected function calculate_overtime_pay_amount($overtime, $salary, $expression)
    {
        if($expression == 1){
            return round(($salary / 173) * $overtime, 2);
        }

        return 10000 * $overtime;
    }
};
