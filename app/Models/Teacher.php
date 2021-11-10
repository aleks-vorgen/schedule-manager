<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static findOrFail(int $id)
 * @method static find(int $id)
 */
class Teacher extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'lesson_title'
    ];
}
