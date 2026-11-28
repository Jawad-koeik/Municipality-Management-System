<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug'])]
class Role extends Model
{
    public const ADMIN = 'admin';

    public const FINANCE_OFFICER = 'finance_officer';

    public const URBAN_PLANNER = 'urban_planner';

    public const HR_MANAGER = 'hr_manager';

    public const CLERK = 'clerk';

    public const CITIZEN = 'citizen';

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
