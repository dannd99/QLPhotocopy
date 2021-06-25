<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    protected $table = 'customer_detail';
    protected $fillable = ['customer_id', 'name', 'address', 'telephone', 'avatar', 'created_at', 'updated_at'];

}
