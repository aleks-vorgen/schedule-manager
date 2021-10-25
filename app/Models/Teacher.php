<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 * @method static create(array $validated)
 */
class Teacher extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'lesson_title'
    ];
}
