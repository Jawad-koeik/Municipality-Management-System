<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['citizen_id', 'type', 'description', 'status', 'submission_date', 'completion_date'])]
class ServiceRequest extends Model
{
    use SoftDeletes;

    protected $table = 'requests';

    protected function casts(): array
    {
        return [
            'submission_date' => 'datetime',
            'completion_date' => 'datetime',
        ];
    }

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class);
    }
}
