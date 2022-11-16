<?php

namespace App\Models;

use App\Helpers\Uuid;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Overtime extends Model
{
    use HasFactory, SoftDeletes, Timestamp;

    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    // public function setDate($value)
    // {
    //     $this->attributes['first_name'] = strtolower($value);
    // }

}
