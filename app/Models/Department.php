<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','status'
    ];

    protected $table = 'department';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
