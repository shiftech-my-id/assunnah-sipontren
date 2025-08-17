<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGroup extends BaseModel
{
    use HasFactory;

    protected $table = 'user_groups';

    protected $fillable = [
        'group_id',
        'name',
        'description',
    ];
}
