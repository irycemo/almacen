<?php

namespace App\Models;

use App\Http\Traits\ModelsTrait;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends SpatieRole
{
    use HasFactory;
    use ModelsTrait;
}
