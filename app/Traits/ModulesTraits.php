<?php

namespace App\Traits;
use App\Models\admin\Module;
trait ModulesTraits {

  // check  permission mpdule

	public function module_id($url){
		$date = Module::where('slug', 'LIKE', "%{$url}%")->select('id','module_name')->first();
		
		if($date){
		//dd($date)	;
		return 	$date->id;
			
		}
		

	}

}