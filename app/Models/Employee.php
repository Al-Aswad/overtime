<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes, Timestamp;

    protected $guarded = [];

    protected $table = 'employees';

    public function overtimes(){

        return $this->hasMany(Overtime::class, 'employee_id', 'id');
    }
}
