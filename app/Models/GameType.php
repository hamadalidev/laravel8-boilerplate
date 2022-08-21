<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GameType
 * @package App\Models
 *
 * @property string name
 */
class GameType extends AbstractModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];
}
