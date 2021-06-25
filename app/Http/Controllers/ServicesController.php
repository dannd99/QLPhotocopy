<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use App\Repositories\ServicesRepository;
use App\Models\Services;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    protected $services;

    public function __construct(Services $services)
    {
        $this->services 	= new ServicesRepository($services);
    }
	// trả về trang quản lí kiểu in
	public function index(Request $request){
		return view('admin.services.index'); 
	}

	// API
    public function get(){
        return $this->services->getAll();
    }
    public function store(Request $request){
        // if (!$this->services->checkHasName($request)) {
            $data = $this->services->store($request);
            // dd($data);
            return $data ? redirect()->route('services.index')->with('success', 'Tạo thành thành công !!')  :  redirect()->route('services.index')->with('success', 'Có lỗi sảy ra !!');
        // }else{
            // return $this->services->sendResponse("[FALSE] - Tên đã tồn tại hoặc không hợp lệ" , 500, false);
        // }
    }
    public function edit($id){
        $service = $this->services->find($id);
        return view("admin.services.edit", compact("service", "id"));
    }
    public function getDelete(Request $request){
        return $this->services->find($request->service_id);
    }

    public function update(Request $request){
        return $this->services->updateData($request) ? redirect()->route('services.index')->with('success', 'Cập nhật thành thành công !!')  :  redirect()->route('services.index')->with('error', 'Có lỗi sảy ra !!');
    }
    public function delete(Request $request){
    	$this->services->delete($request->service_id);
    	return true;
    }
}
