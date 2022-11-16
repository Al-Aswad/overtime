<?php

namespace App\Models;

use App\Helpers\Uuid;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use HasFactory, Uuid, SoftDeletes, Timestamp;

    protected $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];
}
