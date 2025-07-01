<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Menu;
use App\Models\admin\Photogallery;
use App;
use App\Models\admin\MinistersInfo;

class AjaxRequestController extends Controller
{
   // function for get primary menu on ajax request created by laukesh 
   // clean_single_input is helpers function for remove html tags for input/request
    function get_primarylink_menu(Request $request)
	{
        if($request->get_primarylink_menu=='get_primarylink_menu'){
            $language =clean_single_input($request->id);
            
            $data = array();
            $data['html'] = primarylink_menu($language);
             echo json_encode($data);
            die();
        }
	}
 // function for get primary module on ajax request created by laukesh 
    function get_primarylink_module(Request $request)
	{
        if($request->get_primarylink_module=='get_primarylink_module'){
            $language =clean_single_input($request->id);
            
            $data = array();
            $data['html'] = primarylink_module($language);
            echo json_encode($data);
            die();
        }
	}
     // function for filter menu  on ajax request created by laukesh 
    public function get_filter(Request $request)
    {
        if($request->ajax())
        {
            $module=clean_single_input($request->menusearch);
            $title=clean_single_input($request->title);
            $approve_status=clean_single_input($request->approve_status);
            $language_id=clean_single_input($request->language_id);
            App::setLocale($module);
            session()->put('approve_status_'.$module, $approve_status);
            session()->put('language_id_'.$module, $language_id);
            session()->put('title_'.$module,$title);
            session()->put($module,$module);
            $approve_status2=session()->get('approve_status_'.$module);
            $titlesearch=session()->get('title_'.$module);
            $language_idww=session()->get('language_id_'.$module);
            $msg=[
               'module'=> $module,
               'approve_status'=> $approve_status2,
               'language_id'=> $language_idww,
               'title'=> $titlesearch,
            ];
            echo json_encode($msg);
            die();
        }
       
    }
     // function for update menu orders  on ajax request created by laukesh 
    public function update_menu_orders(Request $request)
    {
        $msg=array();
        if($request->ajax())
        {
            $id= clean_single_input( $request->id);
            $pArray['page_postion'] =clean_single_input( $request->page_postion);
            
            $data = Menu::where('id', $id)->first();
           
            if($data->page_postion!==$request->page_postion){

               $create 	= Menu::where('id', $id)->update($pArray);
                $msg['success']='This Postion is Updated';
            }else{
                $msg['error']='This Postion Alredy Taken';
            }
            $lastInsertID = $id;
            $user_login_id=Auth()->user()->id;

            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($data->menu_title),
								'page_action'           =>  'Update',
								'page_category'         =>  clean_single_input($data->m_type),
								'lang'                  =>  clean_single_input($data->language_id),
								'page_title'        	=> 'Menu Model',
								'approve_status'        => clean_single_input($data->approve_status),
								'usertype'          	=> 'Admin'
							);
				// audit_trail is helpers function for insert menu orders  on ajax request  in audit_trail table created by laukesh 			
				audit_trail($audit_data);
                echo json_encode($msg);
                die();
            			
            }
        }
        
    }


    Public function delete_images(Request $request)
    {
        $data=explode(',',$request->rowid);
         $imgname=$data[0];
         $geid=$data[1];
         $data = Photogallery::where('id', $geid)->select('txtuplode')->first();
         $olddata= explode(",",$data->txtuplode);
         if (($key = array_search($imgname, $olddata)) !== false) {
            unset($olddata[$key]);
        }
         $inputdata= implode(",",$olddata);
         $pArray['txtuplode']  	= !empty($inputdata)?$inputdata:'';
         $res= Photogallery::where('id', $geid)->update($pArray);
         $imguplode1 ='upload/admin/cmsfiles//photos/'.$imgname; //die();
               echo   $imguplode1;
               echo "<br>";    
                     if (file_exists($imguplode1)) {
                         unlink($imgname);
                     }
                     $thumbnail1 ='upload/admin/cmsfiles//thumbnail/'.$imgname; //die();
                     echo $thumbnail1;
                     die();
                     if (file_exists($thumbnail1)) {
                         unlink($imgname);
                     }
                     print_r($res);
                     die();  
         if(!empty($res)){
            $newdata = Photogallery::where('id', $geid)->select('txtuplode')->first();
            echo json_encode( $newdata);
         }else{
            $error="Some error";
         }
        
       die();
    }

    public function get_minister_info_type(Request $request)
    {
        $language = $request->input('language');
        $ministerInfo = get_ministers_info_type($language);

        // $data = array();
        // $data['html'] = $ministerInfo;
        // echo json_encode($data);
        // die();

        $options = '<option value="">Select</option>'; // Default "Select" option
        foreach ($ministerInfo as $key => $value) {
            $options .= '<option value="' . $key . '">' . $value . '</option>';
        }
        
        // return response()->json(['minister_info' => $options]);
        return response()->json(['html' => $options]);
    }

     // Function to update sitemap orders
     public function update_sitemap_orders(Request $request)
     {
         $msg=array();
         if($request->ajax())
         {
             $id= clean_single_input( $request->id);
             $pArray['sitemap_positions'] =clean_single_input( $request->sitemap_positions);
             $data = Menu::where('id', $id)->first();
            
             if($data->sitemap_positions!==$request->sitemap_positions){
                $create = Menu::where('id', $id)->update($pArray);
                 $msg['success']='This Postion is Updated';
             }else{
                 $msg['error']='This Postion Alredy Taken';
             }
 
             $lastInsertID = $id;
             $user_login_id=Auth()->user()->id;
 
             if($create > 0){
                 $audit_data = array('user_login_id'     =>  $user_login_id,
                                 'page_id'           	=>  $lastInsertID,
                                 'page_name'             =>  clean_single_input($data->menu_title),
                                 'page_action'           =>  'Update',
                                 'page_category'         =>  clean_single_input($data->m_type),
                                 'lang'                  =>  clean_single_input($data->language_id),
                                 'page_title'        	=> 'Site Map Model',
                                 'approve_status'        => clean_single_input($data->approve_status),
                                 'usertype'          	=> 'Admin'
                             );
                 // audit_trail is helpers function for insert menu orders  on ajax request  in audit_trail table created by laukesh 			
                 audit_trail($audit_data);
                 echo json_encode($msg);
                 die();
                         
             }
         }
         
     }
	 
	public function update_whos_who_orders(Request $request)
    {
		//dd($request->all());
        $msg=array();
        if($request->ajax())
        {
            $id= clean_single_input( $request->id);
            $pArray['info_position'] =clean_single_input( $request->info_position);
            $data = MinistersInfo::where('id', $id)->first();
        
            if($data->info_position !== $request->info_position){
                $create = MinistersInfo::where('id', $id)->update($pArray);
                $msg['success']='This Position is Updated';
            }else{
                $msg['error']='This Position Alredy Taken';
            }

            $lastInsertID = $id;
            $user_login_id=Auth()->user()->id;

            if($create > 0){
                $audit_data = array('user_login_id'     =>  $user_login_id,
                                'page_id'           	=>  $lastInsertID,
                                'page_name'             =>  clean_single_input($data->name),
                                'page_action'           =>  'Update',
                                'page_category'         =>  '',
                                'lang'                  =>  clean_single_input($data->language),
                                'page_title'        	=> "Who's who",
                                'approve_status'        => clean_single_input($data->txtstatus),
                                'usertype'          	=> 'Admin'
                            );
                // audit_trail is helpers function for insert menu orders  on ajax request  in audit_trail table created by laukesh 			
                audit_trail($audit_data);
                echo json_encode($msg);
                die();    
            }
        }
    }
    
}
