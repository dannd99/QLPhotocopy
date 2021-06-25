<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Consts;
use Session;
use Hash;
use DB;

class OrderRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function getAll()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id = null)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    // Custom......................

    public function getOrderCustomer($customer_id){
        return $this->model->where('customer_id', $customer_id)->orderBy('id', 'DESC')->get();
    }

    public function findOrder($customer_id, $id){
        return $this->model->where('customer_id', $customer_id)->where('id', $id)->first() ?? null;
    }
    public function requestRemove($request){
        return $this->model->where('id', '=', $request->orderid)->update([
            'status'     => "6",
        ]);
    }
    public function getOrderStatus($status){
        if ( $status == 0) {
           return $this->model->where('status', '=', $status)->with('customer')->orderBy('id', 'DESC')->get();
        }else{
            if ($status != 100) {
                return $this->model->where('status', '=', $status)->with('customer')->orderBy('id', 'DESC')->get();
            }else{
                return $this->model->orderBy('id', 'DESC')->with('customer')->get();
            }
        }
    }
    public function orderUpdateStatus($order_id, $status){         
            $order = $this->model::find($order_id);
            if ($status == 4) {
                $order->payment_status = 2;     
            }
            $order->status = $status;      
            $order->save(); 
    }

}
