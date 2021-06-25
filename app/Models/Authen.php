<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authen extends Model
{
    protected $table = 'admin_account';
    protected $fillable = ['secret_key', 'email', 'password', 'verify_code', 'created_at', 'updated_at'];
}
