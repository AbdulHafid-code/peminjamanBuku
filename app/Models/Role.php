<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id_role';

    // public $timestamps = false;

    public $guarded = [
        'id_role',
    ];

    public function user(){
        return $this->hasMany(User::class, 'role_id', 'id_role');
    }
}
