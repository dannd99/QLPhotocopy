<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer_account';
    protected $fillable = ['secret_key', 'email', 'password', 'verify_code', 'status', 'created_at', 'updated_at'];

    public function customer_info()
    {
        return $this->hasOne(CustomerInfo::class, 'customer_id');
    }
}
