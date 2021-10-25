<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 * @method static create($validated)
 */
class Student extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'group_id'
    ];
}
