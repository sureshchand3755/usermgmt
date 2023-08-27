<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleType extends Model
{
    use HasFactory;

    protected $table = 'role_type_users';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $softDelete = false;

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_name');
    }
}
