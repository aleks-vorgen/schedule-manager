<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static findOrFail(int $id)
 */
class Group extends Model
{
    protected $fillable = [
        'title'
    ];
}
