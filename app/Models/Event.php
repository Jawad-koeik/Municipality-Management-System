<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['title', 'description', 'date', 'target_audience'])]
class Event extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }
}
