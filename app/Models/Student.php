<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($validated)
 * @method static findOrFail(int $id)
 */
class Student extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'group_id'
    ];
}
