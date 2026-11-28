<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['user_id', 'national_id', 'address', 'contact', 'date_of_birth'])]
class Citizen extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function permits(): HasMany
    {
        return $this->hasMany(Permit::class, 'applicant_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
