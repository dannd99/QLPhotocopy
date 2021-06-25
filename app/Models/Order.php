<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['customer_id', 'services_name', 'services_prices', 'printed_start', 'printed_end', 'url', 'note', 'total_prices', 'status', 'copy', 'slide', 'payment_status', 'created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
