<?php

namespace App;

class Orders
{
	public $customer_id 	= null;
	public $services_id 	= null;
	public $services_name 	= null;
	public $services_prices = null;
	public $printed_start 	= null;
	public $printed_end 	= null;
	public $url 			= null;
	public $note 			= null;
	public $total_prices 	= null;
	public $copy 			= null;
	public $slide 			= null;

	public function __construct(){
	}

	public function create($request, $service){
        $this->customer_id 		= $request->customer_id;
        $this->services_id 		= $service->id;
        $this->services_name 	= $service->name;
        $this->services_prices 	= $service->prices;
        $this->printed_start 	= $request->printed_start;
        $this->printed_end 		= $request->printed_end;
        $this->copy 			= $request->copy;
        $this->url 				= $request->url;
        $this->note 			= $request->note;
        $this->slide 			= $request->slide;
        $this->total_prices 	= ($request->printed_end - $request->printed_start + 1) * $service->prices * $request->copy / $request->slide ;

        if ($this->total_prices % 1000 > 0) {
        	if ($this->total_prices % 1000 > 500) {
        		$this->total_prices = round($this->total_prices / 1000) * 1000;
        	}else{
        		$this->total_prices = round($this->total_prices / 1000) * 1000 + 1000;
        	}
        }
    }

}
