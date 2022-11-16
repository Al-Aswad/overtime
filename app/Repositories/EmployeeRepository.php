<?php

namespace App\Repositories;

use App\Models\Employee;

interface EmployeeRepositoryInterface
{
    public function store(array $attr);
}

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function store(array $attr)
    {
        return Employee::create($attr);
    }
}

;?>
