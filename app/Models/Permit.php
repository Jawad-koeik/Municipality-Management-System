<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['type', 'applicant_id', 'status', 'issue_date', 'expiry_date', 'related_documents'])]
class Permit extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expiry_date' => 'date',
            'related_documents' => 'array',
        ];
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Citizen::class, 'applicant_id');
    }
}
