<?php
  
use Carbon\Carbon;
use App\Models\admin\Audit_trail;
use App\Models\admin\Menu;
use App\Models\User;
use App\Models\admin\Visitor;
use Illuminate\Support\Facades\DB;
use App\Models\admin\WebsiteSetting;
use App\Models\admin\Module;
use App\Models\admin\Title;
use App\Models\admin\Configuration;
use App\Models\Admin_role;
use App\Models\Admin\Logo;
use Illuminate\Support\Str;


  
/**
 * Write code on Method
 *
 * @return response()
 */
if (! function_exists('convertYmdToMdy')) {
    function convertYmdToMdy($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
    }
}
  
/**
 * Write code on Method
 * //dd(convertYmdToMdy('2022-02-12'));
 * @return response()
 */
if (! function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}

if (! function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    { 
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}
// functions for website setting display on blades and controllers created by laukesh 
if (! function_exists('get_setting')) {
    function get_setting($langid="")
    { 
		    $langid=$langid??1;
			$websiteSetting=WebsiteSetting::firstWhere('language', $langid);
			return $websiteSetting;
		
		
    }
}
// functions for remove html tags form input filed  created by laukesh 
if(! function_exists('clean_single_input'))
{
	function clean_single_input($content_desc)
	{
			//$content_desc = trim($content_desc);
			$content_desc = Str::of($content_desc)->trim();
			$content_desc = str_replace('\'','',$content_desc);
			$content_desc = str_replace('&lt;script',' ',$content_desc);
			$content_desc = str_replace('&lt;iframe',' ',$content_desc);
			$content_desc = str_replace('&lt;script&gt;','',$content_desc);
			$content_desc = str_replace('&lt;SCRIPT&gt;','',$content_desc);
			$content_desc = str_replace('&lt;SCRIPT',' ',$content_desc);
			$content_desc = str_replace('&lt;ScRiPt&gt','',$content_desc);
			$content_desc = str_replace('&lt;ScRiPt &gt','',$content_desc);
			$content_desc = str_replace('&lt;IFRAME',' ',$content_desc);
			
			$content_desc = str_replace('sleep','',$content_desc);
			$content_desc = str_replace('waitfor delay','',$content_desc);

			$content_desc = str_replace('iframe','',$content_desc);
			$content_desc = str_replace('script','',$content_desc);
			$content_desc = str_replace('window.','',$content_desc);
			$content_desc = str_replace('prompt','',$content_desc);
			$content_desc = str_replace('Prompt','',$content_desc);
			
			$content_desc = str_replace('confirm','',$content_desc);
			$content_desc = str_replace('CONTENT=','',$content_desc);
			$content_desc = str_replace('HTTP-EQUIV','',$content_desc);
			$content_desc = str_replace('&lt;meta','',$content_desc);
			$content_desc = str_replace('&lt;META','',$content_desc);
			$content_desc = str_replace('data:text/html','',$content_desc);
			$content_desc = str_replace('document.','',$content_desc);
			$content_desc = str_replace('url','',$content_desc);
			$content_desc = str_replace('document.createTextNode','',$content_desc);
			$content_desc = str_replace('document.writeln','',$content_desc);
			$content_desc = str_replace('document.write','',$content_desc);
			$content_desc = str_replace('alert','',$content_desc);
			$content_desc = str_replace('javascript','',$content_desc);
			$content_desc = str_replace('DROP','',$content_desc);
			$content_desc = str_replace('CREATE','',$content_desc);
			$content_desc = str_replace('onsubmit','',$content_desc);
			$content_desc = str_replace('onblur','',$content_desc);
			$content_desc = str_replace('onclick','',$content_desc);
			$content_desc = str_replace('ondatabinding','',$content_desc);
			$content_desc = str_replace('ondblclick','',$content_desc);
			$content_desc = str_replace('ondisposed','',$content_desc);
			$content_desc = str_replace('onfocus','',$content_desc);
			$content_desc = str_replace('onkeydown','',$content_desc);
			$content_desc = str_replace('onkeyup','',$content_desc);
			$content_desc = str_replace('onload','',$content_desc);
			$content_desc = str_replace('onmousedown','',$content_desc);
			$content_desc = str_replace('onmousemove','',$content_desc);
			$content_desc = str_replace('onmouseout','',$content_desc);
			$content_desc = str_replace('onmouseover','',$content_desc);
			$content_desc = str_replace('onmouseup','',$content_desc);
			$content_desc = str_replace('onprerender','',$content_desc); 
			$content_desc = str_replace('onserverclick','',$content_desc);
			$content_desc = str_replace('[removed]','',$content_desc);
			
			$content_desc = str_replace('A=A','',$content_desc);
			$content_desc = str_replace('1=1','',$content_desc);
			
			$content_desc = str_replace('<','',$content_desc);
			$content_desc = str_replace('>','',$content_desc);
			$content_desc = str_replace('< >','',$content_desc);
			$content_desc = str_replace("<''>","",$content_desc);

			$content_desc = str_replace("%","",$content_desc);
			
			$content_desc = str_replace("'or'","",$content_desc);
			$content_desc = str_replace("'OR'","",$content_desc);
			$content_desc = str_replace('"OR"','',$content_desc);
			$content_desc = str_replace('"or"','',$content_desc);
			$content_desc = str_replace("'A","",$content_desc);
			$content_desc = str_replace("A'","",$content_desc);
			$content_desc = str_replace('"A','',$content_desc);
			$content_desc = str_replace('A"','',$content_desc);
			
			$content_desc = str_replace("'1","",$content_desc);
			$content_desc = str_replace("1'","",$content_desc);
			$content_desc = str_replace('"1','',$content_desc);
			$content_desc = str_replace('1"','',$content_desc);
			
			$content_desc = str_replace('(','',$content_desc);
			$content_desc = str_replace(')','',$content_desc);
			//$content_desc = str_replace("(", "",$content_desc);
			//$content_desc = str_replace(")", "",$content_desc);
			
			$content_desc = str_replace('||','',$content_desc);
			$content_desc = str_replace('|','',$content_desc);
			$content_desc = str_replace('&&','',$content_desc);
			$content_desc = str_replace('&','',$content_desc);
			$content_desc = str_replace(';','',$content_desc);
			$content_desc = str_replace('%','',$content_desc);
			$content_desc = str_replace('$','',$content_desc);
			$content_desc = str_replace('"','',$content_desc);
			$content_desc = str_replace("'",'',$content_desc);
			$content_desc = str_replace('\"','',$content_desc);
			$content_desc = str_replace("\'", "", $content_desc);
			$content_desc = str_replace('+','',$content_desc);
			//$content_desc = preg_replace('#[^\w()/.%\-&]#','',$content_desc);
			//$content_desc = str_replace('LF','',$content_desc);
			$content_desc = str_replace('*','',$content_desc);
			$content_desc = str_replace("'<","",$content_desc);
			$content_desc = str_replace("'>","",$content_desc);
			$content_desc = str_replace("<'","",$content_desc);
			$content_desc = str_replace("'>'","",$content_desc);
			$content_desc = str_replace("#40","",$content_desc);
			$content_desc = str_replace("#41","",$content_desc);
			//$content_desc = preg_replace("/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s","",$content_desc);
			
			return $content_desc;
		
	}
	
}
// functions for  replace Special Char form input filed  created by laukesh 
if(! function_exists('replaceSpecialChar'))
{
	function replaceSpecialChar($content_desc)
	{

		$returnText = preg_replace('/[^A-Za-z0-9-.\s]/', '', $content_desc);
		
		return $returnText;
	}
}
// functions for remove  form input filed  created by laukesh 
if(! function_exists('clean_data_array'))
{
	function clean_data_array($aRR)
	{
		$retArr = array();
		foreach($aRR as $key=>$content_desc){	
			
			//$content_desc = trim($content_desc);
			//$content_desc = Str::of($content_desc)->trim();
			$content_desc = str_replace('\'','',$content_desc);
			
			$content_desc = str_replace('&lt;script',' ',$content_desc);
			$content_desc = str_replace('&lt;iframe',' ',$content_desc);
			$content_desc = str_replace('&lt;script&gt;','',$content_desc);
			$content_desc = str_replace('&lt;SCRIPT&gt;','',$content_desc);
			$content_desc = str_replace('&lt;SCRIPT',' ',$content_desc);
			$content_desc = str_replace('&lt;ScRiPt&gt','',$content_desc);
			$content_desc = str_replace('&lt;ScRiPt &gt','',$content_desc);
			$content_desc = str_replace('&lt;IFRAME',' ',$content_desc);
			
			$content_desc = str_replace('sleep','',$content_desc);
			$content_desc = str_replace('waitfor delay','',$content_desc);

			$content_desc = str_replace('iframe','',$content_desc);
			$content_desc = str_replace('script','',$content_desc);
			$content_desc = str_replace('window.','',$content_desc);
			$content_desc = str_replace('prompt','',$content_desc);
			$content_desc = str_replace('Prompt','',$content_desc);
			
			$content_desc = str_replace('confirm','',$content_desc);
			$content_desc = str_replace('CONTENT=','',$content_desc);
			$content_desc = str_replace('HTTP-EQUIV','',$content_desc);
			$content_desc = str_replace('&lt;meta','',$content_desc);
			$content_desc = str_replace('&lt;META','',$content_desc);
			$content_desc = str_replace('data:text/html','',$content_desc);
			$content_desc = str_replace('document.','',$content_desc);
			$content_desc = str_replace('url','',$content_desc);
			$content_desc = str_replace('document.createTextNode','',$content_desc);
			$content_desc = str_replace('document.writeln','',$content_desc);
			$content_desc = str_replace('document.write','',$content_desc);
			$content_desc = str_replace('alert','',$content_desc);
			$content_desc = str_replace('javascript','',$content_desc);
			$content_desc = str_replace('DROP','',$content_desc);
			$content_desc = str_replace('CREATE','',$content_desc);
			$content_desc = str_replace('onsubmit','',$content_desc);
			$content_desc = str_replace('onblur','',$content_desc);
			$content_desc = str_replace('onclick','',$content_desc);
			$content_desc = str_replace('ondatabinding','',$content_desc);
			$content_desc = str_replace('ondblclick','',$content_desc);
			$content_desc = str_replace('ondisposed','',$content_desc);
			$content_desc = str_replace('onfocus','',$content_desc);
			$content_desc = str_replace('onkeydown','',$content_desc);
			$content_desc = str_replace('onkeyup','',$content_desc);
			$content_desc = str_replace('onload','',$content_desc);
			$content_desc = str_replace('onmousedown','',$content_desc);
			$content_desc = str_replace('onmousemove','',$content_desc);
			$content_desc = str_replace('onmouseout','',$content_desc);
			$content_desc = str_replace('onmouseover','',$content_desc);
			$content_desc = str_replace('onmouseup','',$content_desc);
			$content_desc = str_replace('onprerender','',$content_desc); 
			$content_desc = str_replace('onserverclick','',$content_desc);
			$content_desc = str_replace('[removed]','',$content_desc);
			
			$content_desc = str_replace('A=A','',$content_desc);
			$content_desc = str_replace('1=1','',$content_desc);
			
			//$content_desc = str_replace('<','',$content_desc);
			//$content_desc = str_replace('>','',$content_desc);
			$content_desc = str_replace('< >','',$content_desc);
			$content_desc = str_replace("<''>","",$content_desc);

			$content_desc = str_replace("%","",$content_desc);
			
			$content_desc = str_replace("'or'","",$content_desc);
			$content_desc = str_replace("'OR'","",$content_desc);
			$content_desc = str_replace('"OR"','',$content_desc);
			$content_desc = str_replace('"or"','',$content_desc);
			$content_desc = str_replace("'A","",$content_desc);
			$content_desc = str_replace("A'","",$content_desc);
			$content_desc = str_replace('"A','',$content_desc);
			$content_desc = str_replace('A"','',$content_desc);
			
			$content_desc = str_replace("'1","",$content_desc);
			$content_desc = str_replace("1'","",$content_desc);
			$content_desc = str_replace('"1','',$content_desc);
			$content_desc = str_replace('1"','',$content_desc);
			
			$content_desc = str_replace('(','',$content_desc);
			$content_desc = str_replace(')','',$content_desc);
			//$content_desc = str_replace("(", "",$content_desc);
			//$content_desc = str_replace(")", "",$content_desc);
			
			$content_desc = str_replace('||','',$content_desc);
			$content_desc = str_replace('|','',$content_desc);
			$content_desc = str_replace('&&','',$content_desc);
			$content_desc = str_replace('&','',$content_desc);
			$content_desc = str_replace(';','',$content_desc);
			$content_desc = str_replace('%','',$content_desc);
			$content_desc = str_replace('$','',$content_desc);
			$content_desc = str_replace('"','',$content_desc);
			$content_desc = str_replace("'",'',$content_desc);
			$content_desc = str_replace('\"','',$content_desc);
			$content_desc = str_replace("\'", "", $content_desc);
			$content_desc = str_replace('+','',$content_desc);
			//$content_desc = str_replace('CR','',$content_desc);
			//$content_desc = str_replace('LF','',$content_desc);
			$content_desc = str_replace('*','',$content_desc);
			$content_desc = str_replace("'<","",$content_desc);
			$content_desc = str_replace("'>","",$content_desc);
			$content_desc = str_replace("<'","",$content_desc);
			$content_desc = str_replace("'>'","",$content_desc);
			$content_desc = str_replace("#40","",$content_desc);
			$content_desc = str_replace("#41","",$content_desc);
			
			//print_R($content_desc); die();
			$retArr[$key] = $content_desc;
		}
		
		return $retArr;

	}
	
}
// functions for check File Extention in pdf format created by laukesh 
if(!function_exists('checkFileExtention'))
{
        function checkFileExtention($file)
        {
            $gfex = explode('.', $file);
			if(strtolower(end($gfex)) == 'pdf'){
				return 1;
			}else{
				return 0;
			}
        }
}
// functions for store login user activity  created by Laukesh 
if(!function_exists('audit_trail'))
{
	function audit_trail( $data_array = array() )
	{
		
		$whEre 	= array('user_login_id' => isset($data_array['user_login_id'])?$data_array['user_login_id']:'',
					'page_id'           => isset($data_array['page_id'])?$data_array['page_id']:0,
					'page_name'         => isset($data_array['page_name'])?$data_array['page_name']:'',
					'page_action'       => isset($data_array['page_action'])?$data_array['page_action']:'',
					'page_category'     => isset($data_array['page_category'])?$data_array['page_category']:'',
					'page_action_date'  => date('Y-m-d h:i:s'),
					'ip_address'        => $_SERVER['REMOTE_ADDR'],
					'lang'              => isset($data_array['lang'])?$data_array['lang']:1,
					'page_title'        => isset($data_array['page_title'])?$data_array['page_title']:'',
					'approve_status'    => isset($data_array['approve_status'])?$data_array['approve_status']:1,
					'usertype'          => isset($data_array['usertype'])?$data_array['usertype']:''
				 );
		
		$numRows =  Audit_trail::create($whEre);
		return $numRows;
	}
}
/// Module for Admin
// functions for get primary module  created by Laukesh 
if ( ! function_exists('primarylink_module'))
{
	function primarylink_module($language_id, $menu_positions='')
	{
		$selected = "";
		if($menu_positions != '')
		{
			if( $menu_positions == 0 )
				$selected="selected";
		}

		$returnValue = '<div class="col-lg-3 col-md-3 col-xm-3">
							<div class="form-group">
								<label>Primary Link:</label>
								<span class="star">*</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-xm-6">
							<div class="form-group">
								<select name="submenu_id" class="input_class form-control" id="submenu_id" autocomplete="off">
									<option value=""> Select </option>
									<option value ="0" '.$selected.'>It is Root Category</option>';
			
									$whEre = array('module_status'	=> 1,
													'submenu_id'			=> 0,
													'module_language_id'		=> $language_id
												);
									$nav_query = DB::table('modules')->select('id','submenu_id','module_name','icons','slug','mod_order_id','module_status','publish_id_module','module_language_id')->where($whEre)->get();
									foreach($nav_query as $row)
									{
										$selected = "";
										if($menu_positions != '')
										{
											if($row->id == $menu_positions)
												$selected="selected";
										}
										$returnValue .= '<option value="'.$row->id.'" '.$selected.'><strong>'.$row->module_name.'</strong></option>';

														$returnValue .= build_child_m_one($row->id, '', $menu_positions);
									}
								$returnValue .=    		'</select>
							</div>
						</div>';

		return $returnValue;
	}
}

// functions for get child module  created by Laukesh 
if ( ! function_exists('build_child_m_one'))
{
	function build_child_m_one($parent_id, $tempReturnValue, $menu_positions)
	{
            
		$tempReturnValue .= $tempReturnValue;
		$whEre = array("module_status"	=> 1,
						"submenu_id"			=> $parent_id
						);
		$nav_query = DB::table('modules')->select('id','submenu_id','module_name','icons','slug','mod_order_id','module_status','publish_id_module','module_language_id')->where($whEre)->get();
		foreach($nav_query as $row)
		{
			$selected = "";
			if($menu_positions != '')
			{
				if($row->id == $menu_positions)
					$selected="selected";
			}
			$tempReturnValue .= '<option value="'.$row->id.'" '.$selected.'><strong>&nbsp;--&nbsp;'.$row->module_name.'</strong></option>';
			//$tempReturnValue .= build_child_two($row->id, $tempReturnValueAnother='', $menu_positions);
		}

		return $tempReturnValue;
	}
}
############################ Menu For  admin
// functions for get primary  menu  created by Salil
// modify by  laukesh 
   
if ( ! function_exists('primarylink_menu'))
{
	function primarylink_menu($language_id, $menu_positions='')
	{
		$selected = "";
		if($menu_positions != '')
		{
			if( $menu_positions == 0 )
				$selected="selected";
		}

		$returnValue = '<div class="col-lg-3 col-md-3 col-xm-3">
							<div class="form-group">
								<label>Primary Link:</label>
								<span class="star">*</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-xm-6">
							<div class="form-group">
								<select name="menucategory" class="input_class form-control" id="menucategory" autocomplete="off">
									<option value=""> Select </option>
									<option value ="0" '.$selected.'>It is Root Category</option>';
			
			$whEre = array(	'approve_status'	=> 3,
							'm_flag_id'			=> 0,
							'language_id'		=> $language_id
						);
			$nav_query = DB::table('menus')->select('*')->where($whEre)->get();
			foreach($nav_query as $row)
			{
				$selected = "";
				if($menu_positions != '')
				{
					if($row->id == $menu_positions)
						$selected="selected";
				}
				$returnValue .= '<option value="'.$row->id.'" '.$selected.'><strong>'.$row->m_name.'</strong></option>';

                                $returnValue .= build_child_one($row->id, '', $menu_positions);
			}
		$returnValue .=    		'</select>
							</div>
						</div>';

		return $returnValue;
	}
}
// functions for get child  menu  created by Salil
// modify by  laukesh 
if ( ! function_exists('build_child_one'))
{
	function build_child_one($parent_id, $tempReturnValue, $menu_positions)
	{
            
		$tempReturnValue .= $tempReturnValue;
		$whEre = array(	'approve_status'	=> 3,
						'm_flag_id'			=> $parent_id
						);
		$nav_query = DB::table('menus')->select('*')->where($whEre)->get();
		foreach($nav_query as $row)
		{
			$selected = "";
			if($menu_positions != '')
			{
				if($row->id == $menu_positions)
					$selected="selected";
			}
			$tempReturnValue .= '<option value="'.$row->id.'" '.$selected.'><strong>&nbsp;--&nbsp;'.$row->m_name.'</strong></option>';
			$tempReturnValue .= build_child_two($row->id, $tempReturnValueAnother='', $menu_positions);
		}

		return $tempReturnValue;
	}
}
// functions for get child  menu  created by Salil
// modify by  laukesh 
if ( ! function_exists('build_child_two'))
{
	function build_child_two($parent_id, $tempReturnValue, $menu_positions)
	{
            
		$tempReturnValue .= $tempReturnValue;
		$whEre = array(	'approve_status'	=> 3,
						'm_flag_id'			=> $parent_id
						);
		$nav_query = DB::table('menus')->select('*')->where($whEre)->get();
		foreach($nav_query as $row)
		{
			$selected = "";
			if($menu_positions != '')
			{
				if($row->id == $menu_positions)
					$selected="selected";
			}
			$tempReturnValue .= '<option value="'.$row->id.'" '.$selected.'><strong>&nbsp;&nbsp;&nbsp;--&nbsp;'.$row->m_name.'</strong></option>';
			$tempReturnValue .= build_child_three($row->id, $tempReturnValueAnother='', $menu_positions);
		}

		return $tempReturnValue;
	}
}
// functions for get child  menu  created by Salil
// modify by  laukesh 
if ( ! function_exists('build_child_three'))
{
	function build_child_three($parent_id, $tempReturnValue, $menu_positions)
	{
            
		$tempReturnValue .= $tempReturnValue;
		$whEre = array(	'approve_status'	=> 3,
						'm_flag_id'			=> $parent_id
						);
		$nav_query = DB::table('menus')->select('*')->where($whEre)->get();
		foreach($nav_query as $row)
		{
			$selected = "";
			if($menu_positions != '')
			{
				if($row->id == $menu_positions)
					$selected="selected";
			}
			$tempReturnValue .= '<option value="'.$row->id.'" '.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$row->m_name.'</option>';
			$tempReturnValue .= build_child_four($row->id, $tempReturnValueAnother='', $menu_positions);
		}

		return $tempReturnValue;
	}
}

// functions for get child  menu  created by Salil
// modify by  laukesh 

if ( ! function_exists('build_child_four'))
{
	function build_child_four($parent_id, $tempReturnValue, $menu_positions)
	{
            
		$tempReturnValue .= $tempReturnValue;
		$whEre = array(	'approve_status'	=> 3,
						'm_flag_id'			=> $parent_id
						);
		$nav_query = DB::table('menus')->select('*')->where($whEre)->get();
		foreach($nav_query as $row)
		{
			$selected = "";
			if($menu_positions != '')
			{
				if($row->id == $menu_positions)
					$selected="selected";
			}
			$tempReturnValue .= '<option value="'.$row->id.'" '.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$row->m_name.'</option>';
			$tempReturnValue .= build_child_five($row->id, $tempReturnValueAnother='', $menu_positions);
		}

		return $tempReturnValue;
	}
}

// functions for get child  menu  created by Salil
// modify by  laukesh 

if ( ! function_exists('build_child_five'))
{
	function build_child_five($parent_id, $tempReturnValue, $menu_positions)
	{
            
		$tempReturnValue .= $tempReturnValue;
		$whEre = array(	'approve_status'	=> 3,
						'm_flag_id'			=> $parent_id
						);
		$nav_query = DB::table('menus')->select('*')->where($whEre)->get();
		foreach($nav_query as $row)
		{
			$selected = "";
			if($menu_positions != '')
			{
				if($row->id == $menu_positions)
					$selected="selected";
			}
			$tempReturnValue .= '<option value="'.$row->id.'" '.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$row->m_name.'</option>';
			$tempReturnValue .= build_child_six($row->id, $tempReturnValueAnother='', $menu_positions);
		}

		return $tempReturnValue;
	}
}
// functions for get child  menu  created by Salil
// modify by  laukesh 

if ( ! function_exists('build_child_six'))
{
	function build_child_six($parent_id, $tempReturnValue, $menu_positions)
	{
            
		$tempReturnValue .= $tempReturnValue;
		

		$whEre = array(	'approve_status'	=> 3,
						'm_flag_id'			=> $parent_id
						);
		
		$nav_query = DB::table('menus')->select('*')->where($whEre)->get();
		foreach($nav_query as $row)
		{
			$selected = "";
			if($menu_positions != '')
			{
				if($row->id == $menu_positions)
					$selected="selected";
			}
			$tempReturnValue .= '<option value="'.$row->id.'" '.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$row->m_name.'</option>';
			$tempReturnValue .= build_child_seven($row->id, $tempReturnValueAnother='', $menu_positions);
		}

		return $tempReturnValue;
	}
}

// functions for get child  menu  created by Salil
// modify by  laukesh 
if ( ! function_exists('build_child_seven'))
{
	function build_child_seven($parent_id, $tempReturnValue, $menu_positions)
	{
            
		$tempReturnValue .= $tempReturnValue;
		

		$whEre = array(	'approve_status'	=> 3,
						'm_flag_id'			=> $parent_id
						);
		
		$nav_query = DB::table('menus')->select('*')->where($whEre)->get();
		foreach($nav_query as $row)
		{
			$selected = "";
			if($menu_positions != '')
			{
				if($row->id == $menu_positions)
					$selected="selected";
			}
			$tempReturnValue .= '<option value="'.$row->id.'" '.$selected.'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;'.$row->m_name.'</option>';
		}

		return $tempReturnValue;
	}
}


############################menu end

/// Memu for Themes 
// functions for get   menu  created by  Anshu 
if ( ! function_exists('get_menu'))
{
	function get_menu($language_id, $menu_positions, $m_flag_id='')
	{      
		// dd($menu_positions);
		   $whEre = array('approve_status'	=> 3,
							'm_flag_id'			=>$m_flag_id,
							'language_id'		=> $language_id 
						);
			$nav_query = DB::table('menus')->select('*')->where($whEre)->whereIn('menu_positions', $menu_positions)->orderBy('page_postion', 'ASC')->get(); //->orderBy('page_postion', 'ASC')
			

		  return $nav_query;
	}
}


if ( ! function_exists('get_sitemap'))
{
	function get_sitemap($language_id, $menu_positions, $m_flag_id='')
	{      
		// dd($menu_positions);
		   $whEre = array('approve_status'	=> 3,
							'm_flag_id'			=>$m_flag_id,
							'language_id'		=> $language_id 
						);
			$nav_query = DB::table('menus')->select('*')->where($whEre)->whereIn('menu_positions', $menu_positions)->orderBy('sitemap_positions', 'ASC')->get();
			

		  return $nav_query;
	}
}

// functions for create seo link and text created by  Anshu 
if ( ! function_exists('seo_url'))
{
	function seo_url($seo_url){

		$seo_url = preg_replace('/\s+/', ' ',$seo_url);
		$seo_url = str_replace('&','-',$seo_url);
		$seo_url = str_replace('amp;','and',$seo_url);
		$seo_url = str_replace('/','',$seo_url);
		$seo_url = str_replace('%','',$seo_url);
		$seo_url = str_replace('*','',$seo_url);
		$seo_url = str_replace('(','',$seo_url);
		$seo_url = str_replace(')','',$seo_url);
		$seo_url = str_replace('!','',$seo_url);
		$seo_url = str_replace('@','',$seo_url);
		$seo_url = str_replace('#','',$seo_url);
		$seo_url = str_replace('}','',$seo_url);
		$seo_url = str_replace('{','',$seo_url);
		$seo_url = str_replace(']','',$seo_url);
		$seo_url = str_replace('[','',$seo_url);
		$seo_url = str_replace(',','-',$seo_url);
		$seo_url = str_replace('.','',$seo_url);
		$seo_url = str_replace('?','',$seo_url);
		$seo_url = str_replace("'",'',$seo_url);
		$seo_url = str_replace(' ','-',$seo_url);	
		return strtolower($seo_url).'.php';
	}
}
// functions for cheked status created by  laukesh 
if ( ! function_exists('get_status'))
{
	function get_status($user_type = null)
	{

		if (!isset($user_type)) {
			return array(
				'1' => "Draft",
				'2' => "Aproval",
				'3' => "Publish"
			);
		}
		
		$status = array();
		if($user_type == 2){
			$status = array(
				'1'	=> "Draft",
				'2'	=> "Aproval"
			);
		}else if($user_type == 3){
			$status = array(
				'2'	=> "Aproval",
				'3'	=> "Publish"
			);
		}else{
			$status = array(
				'1'	=> "Draft",
				'2'	=> "Aproval",
				'3'	=> "Publish"
			);
		}
		
		return $status;
	}
}
// functions for set postions of menu created by  laukesh 
if ( ! function_exists('get_content_postion'))
{
	function get_content_postion()
	{

		$postion = array(
			        '1'	=> "Header Menu",
					'2'	=> "Common Menu",
					'3'	=> "Footer Menu",
					'4'	=> "Header & Footer Menu"
					);
		return $postion;
	}
}
// functions for get/set language created by  laukesh 
if ( ! function_exists('get_language'))
{
	function get_language()
	{

		$language = array(
			        '1'	=> "English",
					'2'	=> "Hindi"
					 );
		return $language;
	}
}
// functions for get/set status active/inactive created by  laukesh 
if ( ! function_exists('get_active'))
{
	function get_active()
	{

		$language = array(
			        '1'	=> "Active",
					'2'	=> "In Active"
					 );
		return $language;
	}
}

// functions for count number of child menu created by  laukesh 
if ( ! function_exists('has_child'))
{
	function has_child( $pid,$langid=1){
		
		$fetchResult =DB::table('menus')->where('m_flag_id', $pid)->where('language_id', $langid)->where('approve_status', 3)->exists();
		return $fetchResult;
		
	}
}
// functions for count number of child modules created by  laukesh 
if ( ! function_exists('has_m_child'))
{
	function has_m_child($pid,$langid=1){
		$fetchResult =DB::table('modules')->where('submenu_id', $pid)->where('module_language_id', $langid)->where('module_status', 1)->exists();
		return $fetchResult;
		
	}
}
// functions for checked language created by  laukesh 
function language($val)
	{
	if($val=='2')
	echo "Hindi";
	else if($val=='3')
		echo "Marathi";
	else if($val=='4')
		echo "Gujarati";
	else if($val=='5')
		echo "Telugu";
	else if($val=='6')
		echo "Tamil";
	else if($val=='7')
		echo "Kannada";
	else if($val=='1')
		echo "English";
	else
	echo "English";
}
// functions for checked status created by  laukesh 
   function status($val){
		if($val=='1')
		{
		echo "Draft";
		}
		else if($val=='2')
		{
		echo "For Approval";
		}
		else if($val=='3')
		{
			echo "Publish";
		}else{
		  echo "Review";
     	}
	}
	// functions for checked status of module  created by  laukesh 
	function status_m($val){
		if($val=='1')
		{
		echo "Active";
		}
		else if($val=='2')
		{
		echo "Inactive";
		}
	}
	
// functions for get parents modules of list in sidebar  created by  laukesh 
	if ( ! function_exists('admin_sidebar'))
	{
		function admin_sidebar($langid=1){
			
			$fetchResult =DB::table('modules')->where('submenu_id', 0)->where('module_language_id', $langid)->where('module_status', 1)->get();
			return $fetchResult;
			
		}
	}
// functions for get child modules of list in sidebar  created by  laukesh 
	if ( ! function_exists('admin_sidebar_chid'))
	{
		function admin_sidebar_chid($langid=1,$mid){
			
			$fetchResult =DB::table('modules')->where('submenu_id', $mid)->where('module_language_id', $langid)->where('module_status', 1)->get();
			return $fetchResult;
			
		}
	}
	// functions for get/set usertype  created by  laukesh 
	if ( ! function_exists('get_usertype'))
	{
		function get_usertype()
		{

			$language = array(
						'1'	=> "Creator",
						'2'	=> "Publisher",
						'3'	=> "Both"
						);
			return $language;
		}
	}
	
	if ( ! function_exists('get_user_role'))
	{
		function get_user_role($role_id)
		{

			if($role_id=='1')
			{
				echo "Creator";
			}
			else if($role_id=='2')
			{
				echo "Publisher";
			} elseif($role_id=='3') {
				echo "Both";
			}
		}
	}
		// functions for get/set themestype  created by  laukesh 
	if ( ! function_exists('get_themestype'))
	{
		function get_themestype()
		{

			$Theme = array(
						'th1'	=> "Theme 1",
						'th2'	=> "Theme 2",
						'th3'	=> "Theme 3"
						);
			return $Theme;
		}
	}

	// 07-11-2024
	// if ( ! function_exists('get_noticetype'))
	// {
	// 	function get_noticetype()
	// 	{

	// 		$Theme = array(
	// 					'1'	=> "Brochure",
	// 					'2'	=> "Press Release",
	// 					'3'	=> "Events",
	// 					'4'	=> "Notifications",
	// 					'6'=>  "Exhibition"
	// 					);
	// 		return $Theme;
	// 	}
	// }
	if ( ! function_exists('get_recruitmenttype'))
	{
		function get_recruitmenttype()
		{

			$Theme = array(
					'1'	=> "Circular",
					'2'	=> "Vacancy",
				);
			return $Theme;
		}
	}



	// functions for get/set circularstype 
	if ( ! function_exists('circularstype'))
	{
		function circularstype($type)
		{

			// if($type==1){
			// 	$type='Brochure';
			// }elseif($type==2){
			// 	$type='Press Release';
			// }elseif($type==3){
			// 	$type='Events';
			
			// }elseif($type==4){
			// 	$type='Notifications';
			
			// }else{
			// 	$type='Exhibition';
			// }
			if($type==1){
				$type='Circular';
			}else{
				$type='Vacancy';
			}
			return $type;
		}
	}
		// functions for get/set permissions of modules for users  created by  laukesh 

	if ( ! function_exists('show_permissions'))
	{
		function show_permissions()
		{

			$Theme = array(
						'1'	=> "View",
						'2'	=> "Add",
						'3'	=> "Edit",
						'4'	=> "Delete"
						);
			return $Theme;
		}
	}

	if ( ! function_exists('explode_filed'))
	{
		function explode_filed($feild)
		{
			$feild=session()->get($feild);
			$feild = explode('_',$feild);
			$feild=$feild[1];
			return $$feild;
		}
	}
// functions for get website visitor count page wise created by  laukesh 
	if(!function_exists('get_visitor_count'))
	{

		function get_visitor_count()
		{
			$langid = session()->get('locale');
			
			if($langid == 1){
				$counter = DB::table('visitors')
				->where('language', 1) // English
				->sum('visitors_count');

				return $counter;
			}else{
				$counter = DB::table('visitors')
				->where('language', 2) // Hindi
				->sum('visitors_count');

				return $counter;
			}
		}

			// function get_visitor_count()
			// {
			// 	$counter=	DB::table('visitors')->sum('visitors_count');;
			//     return $counter;
			// }
	}
// functions for updates website visitor count  created by  Anshu 
	if (!function_exists('update_visitor_count')) {
		function update_visitor_count($visitors_ip, $page)
		{
			
			$userAgent = $_SERVER['HTTP_USER_AGENT'];
			$browser = get_browser_name($userAgent);
			$device = get_device_type($userAgent);
			$dataVis = array();

			$today = now()->format('Y-m-d H:i:s');
			$langid = session()->get('locale');
			$visitThresholdMinutes = 1; // Define a threshold for considering a revisit (e.g., 10 minutes)

			if ($langid) {
				$result = Visitor::where('visitors_ip', $visitors_ip)
							->where(function($query) use ($langid) {
								$query->where('language', $langid)
									->orWhereNull('language');
							})
							->first();

				if ($result) {
					// Check if the last visit was more than the threshold time ago
					$lastVisit = $result->updated_at;
					$timeSinceLastVisit = now()->diffInMinutes($lastVisit);

					if ($timeSinceLastVisit > $visitThresholdMinutes) {
						$vc = $result['visitors_count'] + 1;
						$dataVis['visitors_count'] = $vc;
						$dataVis['browser'] = $browser;  
						$dataVis['device'] = $device;
						$dataVis['updated_at'] = $today; 
						
						Visitor::where('id', $result->id)
							->update($dataVis);
					} else {
						// Update only the browser and device without incrementing the count
						$dataVis['browser'] = $browser;
						$dataVis['device'] = $device;
						$dataVis['updated_at'] = $today;

						Visitor::where('id', $result->id)
							->update($dataVis);
					}
				} else {
					// If no record exists for this visitor, create a new one
					$dataVis['visitors_count'] = 1;
					$dataVis['page_name'] = $page;
					$dataVis['visitors_ip'] = $visitors_ip;
					$dataVis['visitors_date_time'] = $today;
					$dataVis['browser'] = $browser;
					$dataVis['device'] = $device;
					$dataVis['language'] = $langid;

					Visitor::create($dataVis);
				}
			}





			// $result = Visitor::where('visitors_ip', $visitors_ip)->first();
			
			// Capture the user agent (browser and device)
			// $userAgent = $_SERVER['HTTP_USER_AGENT'];
			// $browser = get_browser_name($userAgent);
			// $device = get_device_type($userAgent);
			// $dataVis = array();

			// $today = now()->format('Y-m-d');;
			// $langid = session()->get('locale');

			// if ($langid) {
			// 	$result = Visitor::where('visitors_ip', $visitors_ip)
			// 					->where('language', $langid)
			// 					// ->whereDate('updated_at', $today)
			// 					->first();
				
			// 	if ($result) {
			// 		// if ($result->updated_at->toDateString() != $today) {
			// 			$vc = $result['visitors_count'] + 1;
			// 			$dataVis['visitors_count'] = $vc;
			// 			$dataVis['browser'] = $browser;  
			// 			$dataVis['device'] = $device; 
				
			// 			Visitor::where('id', $result->id)
			// 				->update($dataVis);
			// 		// }
			// 	} else {
			// 		$dataVis['visitors_count'] = 1;
			// 		$dataVis['page_name'] = $page;
			// 		$dataVis['visitors_ip'] = $visitors_ip;
			// 		$dataVis['visitors_date_time'] = date('Y-m-d H:i:s');
			// 		$dataVis['browser'] = $browser;
			// 		$dataVis['device'] = $device;
			// 		$dataVis['language'] = $langid;
			
			// 		Visitor::create($dataVis);
			// 	}
				
			// }





		// old code 

		// if ($result) {
		//     // Increment visitor count if the IP already exists in the database
		//     $vc = ($result['visitors_count']) + 1;
		//     $dataVis['visitors_count'] = $vc;
		//     $dataVis['browser'] = $browser;  // Save browser information
		//     $dataVis['device'] = $device;    // Save device information
			
		//     // Update the visitor entry with the new visit count, browser, and device
		//     Visitor::where('visitors_ip', $result['visitors_ip'])->update($dataVis);
		// } else {
		//     // Create a new visitor entry
		//     $dataVis['visitors_count'] = 1;
		//     $dataVis['page_name'] = $page;
		//     $dataVis['visitors_ip'] = $visitors_ip;
		//     $dataVis['visitors_date_time'] = date('Y-m-d H:i:s');
		//     $dataVis['browser'] = $browser;
		//     $dataVis['device'] = $device;
			
		//     // Insert new visitor data
		//     $create = Visitor::create($dataVis);
		//     $id = $create->id;
		// }
	}
}

/**
 * Function to detect the browser name from the user agent.
 */
function get_browser_name($userAgent)
{
    // Case insensitive regex match for common browsers
    if (preg_match('/MSIE|Trident/i', $userAgent)) {
        return 'Internet Explorer';
    } elseif (preg_match('/Firefox/i', $userAgent)) {
        return 'Firefox';
    } elseif (preg_match('/Chrome/i', $userAgent) && !preg_match('/Edge/i', $userAgent)) {
        return 'Chrome';
    } elseif (preg_match('/Safari/i', $userAgent) && !preg_match('/Chrome/i', $userAgent)) {
        return 'Safari';
    } elseif (preg_match('/Opera|OPR/i', $userAgent)) {
        return 'Opera';
    } elseif (preg_match('/Edge/i', $userAgent)) {
        return 'Edge';
    } elseif (preg_match('/Mobile/i', $userAgent) && preg_match('/AppleWebKit/i', $userAgent)) {
        return 'Safari Mobile';  // For Safari on mobile devices
    } else {
        return 'Other';
    }
}

/**
 * Function to detect the device type from the user agent.
 */
function get_device_type($userAgent)
{
    // Check for mobile devices
    if (preg_match('/mobile/i', $userAgent)) {
        return 'Mobile';
    }
    // Check for tablet devices (e.g., iPads, Android tablets)
    elseif (preg_match('/tablet/i', $userAgent)) {
        return 'Tablet';
    }
    // Check for iPads specifically
    elseif (preg_match('/iPad/i', $userAgent)) {
        return 'Tablet';
    }
    // Check for Android devices (common Android tablets and phones)
    elseif (preg_match('/Android/i', $userAgent)) {
        return 'Mobile';
    }
    // Check for iPhone devices
    elseif (preg_match('/iPhone/i', $userAgent)) {
        return 'Mobile';
    }
    // Check for common desktop patterns
    elseif (preg_match('/desktop/i', $userAgent) || preg_match('/windows/i', $userAgent) || preg_match('/macintosh/i', $userAgent)) {
        return 'Desktop';
    }
    // Default fallback for unknown device types
    else {
        return 'Unknown';
    }
}

// functions for  get last updated date of pages created by  laukesh 
	if(!function_exists('get_last_updated_date'))
	{
			function get_last_updated_date( $pageTitle = "")
			{
				//dd($pageTitle);
				if($pageTitle != ""){	
					 $result = Audit_trail::where('approve_status', '=', 3)->where('page_title', 'LIKE','%'.$pageTitle.'%')->orderby('updated_at','DESC')->select('updated_at')->first();
					
					if($result){
						return date("d-m-Y", strtotime($result['updated_at']));
					}else{
						$result = Audit_trail::where('approve_status', '=', 3)->orderby('updated_at','DESC')->select('updated_at')->first();
						return date("d-m-Y", strtotime($result['updated_at']));
					}
					
				}
				else{
					$result = Audit_trail::where('approve_status', '=', 3)->orderby('updated_at','DESC')->select('updated_at')->first();
					return date("d-m-Y", strtotime($result['updated_at']));
				}
				
			}
	}
	/// clinet Logo 
// functions for  get  clinet Logo  created by  laukesh 
if ( ! function_exists('get_logolist'))
{
	function get_logolist($langid)
	{      
		   $whEre = array('txtstatus'	=> 3,
		   					'language' => $langid,
							'txttype' => 1
						);
			$nav_query = DB::table('logos')->select('*')->where($whEre)->orderBy('updated_at', 'DESC')->get();

		  return $nav_query;
	}
}
// functions for  get  parent menu name  using title and language id created by  laukesh 
if ( ! function_exists('get_parent_menu_name'))
{
	function get_parent_menu_name($url,$langid1)
	{      
		$result= '';
	     $date = Menu::where('m_url', 'LIKE', "%{$url}%")->where('language_id', '=', $langid1)->where('approve_status', '=', 3)->select('m_flag_id')->first();
		 if($date){
		 $result= Menu::where('id', $date->m_flag_id)->select('m_url','m_name')->first();
		  }
		  return $result;
	}
}
// functions for  check  permission mpdule created by  laukesh 
if ( ! function_exists('module_permission'))
{
	function module_permission($user_id = ''){
		$date = Admin_role::where('user_id', '=', $user_id)->select('role_id','permissions','module_id')->first();
		
		if($date){
			
		return 	$date;
			
		}
		

	}
}
//  functions for  check if user has permission created by  laukesh 
if ( ! function_exists('has_module_permission'))
{
	function has_module_permission($permission_name='', $user_id = '',$mid='', $pageurl=''){
		$date = Admin_role::where('user_id', '=', $user_id)->select('role_id','permissions','module_id')->first();
		if($date){
			
			 $permissions=explode(',',$date->permissions);
			$pre=explode(',',$date->module_id);
			$preModule=$mid.'_'.$permission_name;
			   
				if(in_array($preModule, $permissions)){
					return true;
				}else{
				   //abort(401, 'This action is unauthorized.');
				   echo '
					<script>
						alert("You do not have permission to access this module.");
						
						window.location.href = "' . url('admin/'.$pageurl) . '";
					</script>
					';
					exit;
				}
			
			
		}
		

	}
}
// functions for Title by view title 
if ( ! function_exists('get_title'))
{
	function get_title($title,$langid){
		$date = Title::where('titleType', 'title')->where('page_url', '=', "{$title}" )->where('language', '=', $langid)->where('txtstatus', '=', '3')->select('title','icons','txtstatus')->first();
		
		if($date){
			
		return 	$date;
			
		}
		

	}
}

// functions for Icons 
if ( ! function_exists('get_icons'))
{
	function get_icons($langid){
		$date = Title::where('titleType', 'socialMedia')->where('language', '=', $langid)->where('txtstatus', '=', '3')->get();
		
		if($date){
			return 	$date;
		}
		
	}
}

if ( ! function_exists('get_mailsms_details'))
{
	function get_mailsms_details($langid,$cof_type)
	{
		$data = Configuration:: where('cof_type', $cof_type)->where('language', $langid)->where('status', '1')->select('language','sms_url','sender_name','sender_mail','cof_type','password','port','contact_msg','reset_pass_msg','reg_msg','feedback_msg')->first();
		if($data)
		{
		return $data;
		}
	}


}

/**
 * Random Logo
 */
if(!function_exists('random_logo_header')){
	function random_logo_header(){
		$data = Logo::inRandomOrder()->get();

		$random_logo = [];
		$random_link = [];
		foreach($data as $val){
			$random_logo[] = asset("public/upload/admin/cmsfiles/logo/thumbnail/".$val->txtuplode);
			$random_link[] = $val->logo_url;
		}
		// return $random_logo;
		return [
			'random_logo' => $random_logo,
			'random_link' => $random_link,
		];

		// return $data->map(function ($data) {
        //     return asset("public/upload/admin/cmsfiles/logo/thumbnail/".$data->txtuplode);
        // })->toArray();

		// return $data ? asset("public/upload/admin/cmsfiles/logo/thumbnail/".$data->txtuplode) : null;
		// return $data;
	}
}


// Types of ministers info
// Types of ministers info
if(!function_exists('get_ministers_info_type')){
	function get_ministers_info_type($language_id = 1){
		
		$Theme = DB::table('minister_info_categories')->where('language', $language_id)->get()->pluck('category_name', 'id')
		->toArray();

		return $Theme;
		
		// $Theme = array(
		// 	'1' => 'Minister for Consumer Affairs, Food & Public Distribution',
		// 	'2' => 'Minister of State for Consumer Affairs, Food & Public Distribution',
		// 	'3' => 'Secretary (Consumer Affairs)',
		// 	'4' => 'Additional Secretary & Financial Advisor (AS&FA)',
		// 	'5' => 'Additional Secretary (Consumer Affairs)',
		// 	'6' => 'Senior Economic Adviser (Consumer Affairs)',
		// 	'7' => 'Joint Secretary , Economic Advisor and Chief Controller of Accounts',
		// 	'8' => 'Director',
		// 	'9' => 'Deputy Secretary',
		// 	'10' => 'Under Secretary and Deputy Director',
		// 	'11' => 'Assistant Director',
		// 	'12' => 'Section Officer',
		// 	'13' => 'Pay and Accounts Officers and Assistant Account Officers',
		// 	'14' => 'NIC Unit',
		// 	'15' => 'Other Utility Services'
		// );

		//$Theme_en = array(
        //    '1' => 'Minister for Consumer Affairs, Food & Public Distribution',
        //    '2' => 'Minister of State for Consumer Affairs, Food & Public Distribution',
        //    '3' => 'Minister of State for Consumer Affairs, Food & Public Distribution.',
        //    '4' => 'Secretary (Consumer Affairs)',
        //    '5' => 'Additional Secretary & Financial Advisor (AS&FA)',
        //    '6' => 'Additional Secretary (Consumer Affairs)',
        //    '7' => 'Senior Economic Adviser (Consumer Affairs)',
        //    '8' => 'Joint Secretary, Economic Advisor and Chief Controller of Accounts',
        //    '9' => 'Director',
        //    '10' => 'Deputy Secretary / Joint Director',
        //    '11' => 'Under Secretary and Deputy Director',
        //    '12' => 'Assistant Director',
        //    '13' => 'Section Officer',
        //    '14' => 'Pay and Accounts Officers and Assistant Account Officers',
        //    '15' => 'NIC Unit',
        //    '16' => 'Other Utility Services'
        //);
		//
        //$Theme_hi = array(
        //    '1' => 'उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण मंत्री',
        //    '2' => 'उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण राज्य मंत्री',
        //    '3' => 'उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण राज्य मंत्री|',
        //    '4' => 'सचिव (उपभोक्ता मामले)',
        //    '5' => 'अपर सचिव और वित्तीय सलाहकार (एएस एंड एफए)',
        //    '6' => 'अपर सचिव (उपभोक्ता मामले)',
        //    '7' => 'वरिष्ठ आर्थिक सलाहकार (उपभोक्ता मामले)',
        //    '8' => 'संयुक्त सचिव, आर्थिक सलाहकार और मुख्य नियंत्रक लेखा',
        //    '9' => 'निर्देशक',
        //    '10' => 'उप सचिव',
        //    '11' => 'अवर सचिव और उप निदेशक',
        //    '12' => 'सहायक निदेशक',
        //    '13' => 'अनुभाग अधिकारी',
        //    '14' => 'भुगतान और लेखा अधिकारी और सहायक लेखा अधिकारी',
        //    '15' => 'एनआईसी इकाई',
        //    '16' => 'अन्य उपयोगिता सेवाएं'
        //);
		//
        //return $language_id == 2 ? $Theme_hi : $Theme_en;

		// return $Theme;
	}
}

if (!function_exists('ministers_info_type'))
{
	function ministers_info_type($type, $language)
	{
		$type = DB::table('minister_info_categories')->where('id', $type)->where('language', $language)->value('category_name');
		
		//if ($language == 2) {
		//	if ($type == 1) {
		//		$type = 'उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण मंत्री';
		//	} elseif ($type == 2) {
		//		$type = 'उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण राज्य मंत्री';
		//	} elseif ($type == 3) {
		//		$type = 'उपभोक्ता मामले, खाद्य और सार्वजनिक वितरण राज्य मंत्री|';
		//	} elseif ($type == 4) {
		//		$type = 'सचिव (उपभोक्ता मामले)';
		//	} elseif ($type == 5) {
		//		$type = 'अपर सचिव और वित्तीय सलाहकार (एएस एंड एफए)';
		//	} elseif ($type == 6) {
		//		$type = 'अपर सचिव (उपभोक्ता मामले)';
		//	} elseif ($type == 7) {
		//		$type = 'वरिष्ठ आर्थिक सलाहकार (उपभोक्ता मामले)';
		//	} elseif ($type == 8) {
		//		$type = 'संयुक्त सचिव, आर्थिक सलाहकार और मुख्य नियंत्रक लेखा';
		//	} elseif ($type == 9) {
		//		$type = 'निर्देशक';
		//	} elseif ($type == 10) {
		//		$type = 'उप सचिव';
		//	} elseif ($type == 11) {
		//		$type = 'अवर सचिव और उप निदेशक';
		//	} elseif ($type == 12) {
		//		$type = 'सहायक निदेशक';
		//	} elseif ($type == 13) {
		//		$type = 'अनुभाग अधिकारी';
		//	} elseif ($type == 14) {
		//		$type = 'भुगतान और लेखा अधिकारी और सहायक लेखा अधिकारी';
		//	} elseif ($type == 15) {
		//		$type = 'एनआईसी इकाई';
		//	} elseif ($type == 16) {
		//		$type = 'अन्य उपयोगिता सेवाएं';
		//	}
		//} else {
		//	if ($type == 1) {
		//		$type = 'Minister for Consumer Affairs, Food & Public Distribution';
		//	} elseif ($type == 2) {
		//		$type = 'Minister of State for Consumer Affairs, Food & Public Distribution';
		//	} elseif ($type == 3) {
		//		$type = 'Minister of State for Consumer Affairs, Food & Public Distribution.';
		//	} elseif ($type == 4) {
		//		$type = 'Secretary (Consumer Affairs)';
		//	} elseif ($type == 5) {
		//		$type = 'Additional Secretary & Financial Advisor (AS&FA)';
		//	} elseif ($type == 6) {
		//		$type = 'Additional Secretary (Consumer Affairs)';
		//	} elseif ($type == 7) {
		//		$type = 'Senior Economic Adviser (Consumer Affairs)';
		//	} elseif ($type == 8) {
		//		$type = 'Joint Secretary , Economic Advisor and Chief Controller of Accounts';
		//	} elseif ($type == 9) {
		//		$type = 'Director';
		//	} elseif ($type == 10) {
		//		$type = 'Deputy Secretary / Joint Director';
		//	} elseif ($type == 11) {
		//		$type = 'Under Secretary and Deputy Director';
		//	} elseif ($type == 12) {
		//		$type = 'Assistant Director';
		//	} elseif ($type == 13) {
		//		$type = 'Section Officer';
		//	} elseif ($type == 14) {
		//		$type = 'Pay and Accounts Officers and Assistant Account Officers';
		//	} elseif ($type == 15) {
		//		$type = 'NIC Unit';
		//	} elseif ($type == 16) {
		//		$type = 'Other Utility Services';
		//	}
		//}
		
		return $type;
	}
}