<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    use HasFactory;
    public $timestamps = false;
    public $guard_name = 'admin';
    protected $fillable = [
        'role_title',
    ];

    
}
