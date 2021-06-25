<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Consts;
use Session;
use Hash;
use DB;

class ServicesRepository extends BaseRepository implements RepositoryInterface
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

    public function checkHasName($request){
        return $this->model->where('name', '=', $request->name)->first() ? true : false;
    }
    public function store($request){

        // them list anh vao DB,
        $image_list = "";
        $images = $request->upload_list;
        foreach ($images as $key => $value) {
            $imageitem = time() . static::to_reset($value->getClientOriginalName());

            $value->move(public_path('images'), $imageitem);
            $image_list = $image_list . 'images/'.$imageitem . " | ";
        }

        $image = $request->upload_avatar;
        $imageitem = time() . static::to_reset($image->getClientOriginalName());
        $image->move(public_path('images'), $imageitem);

        try {
            $data = $this->model->create([
                'name'          => $request->name,
                'prices'        => $request->prices,
                'image'         => 'images/'.$imageitem,
                'images'        => $image_list,
                'description'   => $request->description,
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            return false;
            DB::rollBack();
            return $exception;
        }
    }

    public function updateData($request){
        $image_list = "";
        $image_avatar = "";
        if ($request->upload_list != null) {
            // them list anh vao DB,
            $images = $request->upload_list;
            foreach ($images as $key => $value) {
                $imageitem = time() . static::to_reset($value->getClientOriginalName());

                $value->move(public_path('images'), $imageitem);
                $image_list = $image_list . 'images/'.$imageitem . " | ";
            }
            if ($request->upload_avatar != null) {
                $image = $request->upload_avatar;
                $image_avatar = time() . static::to_reset($image->getClientOriginalName());
                $image->move(public_path('images'), $image_avatar);
            }
        }
        try {
            if ($image_list != "" && $image_avatar == "") {
                $data = $this->model->where("id", "=", $request->id)->update([
                    'name'          => $request->name,
                    'prices'        => $request->prices,
                    'images'        => $image_list,
                    'description'   => $request->description,
                ]);
            }else if ($image_list == "" && $image_avatar != "") {
                $data = $this->model->where("id", "=", $request->id)->update([
                    'name'          => $request->name,
                    'prices'        => $request->prices,
                    'image'         => 'images/'.$imageitem,
                    'description'   => $request->description,
                ]);
            }else if ($image_list != "" && $image_avatar != "") {
                $data = $this->model->where("id", "=", $request->id)->update([
                    'name'          => $request->name,
                    'prices'        => $request->prices,
                    'image'         => 'images/'.$imageitem,
                    'images'        => $image_list,
                    'description'   => $request->description,
                ]);
            }else{
                $data = $this->model->where("id", "=", $request->id)->update([
                    'name'          => $request->name,
                    'prices'        => $request->prices,
                    'description'   => $request->description,
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            return false;
            DB::rollBack();
            return $exception;
        } 
    }

    // show the record with the given name
    public function findName($name)
    {
        return $this->model->where('name', $name)->first();
    }


    
}
