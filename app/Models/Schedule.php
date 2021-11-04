<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 */
class Schedule extends Model
{
    protected $fillable = [
        'date_time_begin',
        'date_time_end',
        'group_id',
        'teacher_id'
    ];
}
