<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Consts;
use Session;
use Hash;
use DB;

class CustomerRepository extends BaseRepository implements RepositoryInterface
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

    
    public function getCustomer($id)
    {
        return $this->model->where('id', $id)->with('customer_info')->first();
    }
    public function getAllCustomer()
    {
        return $this->model->with('customer_info')->get();
    }
    public function updateCustomer($user_id, $request)
    {   
        $image = $request->avatar;
        if ($image != null) {
            $imageitem = time() . static::to_reset($image->getClientOriginalName());
            $image->move(public_path('images'), $imageitem);
            DB::table('customer_detail')->where('id', '=', $user_id)->update([
                'avatar'        => 'images/'.$imageitem,
                'name'          => $request->name,
                'address'       => $request->address,
                'telephone'     => $request->telephone,
            ]);
        }else{
            DB::table('customer_detail')->where('id', '=', $user_id)->update([
                'name'          => $request->name,
                'address'       => $request->address,
                'telephone'     => $request->telephone,
            ]);
        }
        return true;
    }
    public function customerBlock($id){
        $user = $this->model->where('id', $id)->first();
        $status = $user->status;
        $this->model->where('id', $id)->update([
            'status'          => !$status,
        ]);
    }

    // đổi mật khẩu
    public function password($request, $user_id){
        // lấy ra dữ liệu trong request
        $request_data = $request->All();
        // lấy ra mật khẩu cũ
        $current_password =$this->model->where('id', $user_id)->first()->password;
        // Kiểm tra mật khẩu cũ   
        if(Hash::check($request_data['current-password'], $current_password)) {      
            // lấy user cần đổi                 
            $obj_user = $this->model::find($user_id);
            // lấy tạo mật khẩu mới               
            $obj_user->password = Hash::make($request_data['password']);
            // lấy tạo secret key               
            $obj_user->secret_key = mt_rand(1000000, 9999999);
            // lưu lại
            $obj_user->save(); 
            return true;
        } else {   
            // trả về false nếu mật khẩu cũ không chính xác        
            return false;
        }
    }
    
}
