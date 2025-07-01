<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Circular;
use App\Models\admin\Corrigendum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the Recruitment.
     */
    public function index()
    {
        $title="Manage Recruitment";
        $approve_status=session()->get('approve_status');
        $sertitle=Session::get('Mtitle');
        $circularstype=Session::get('circularstype');
        $approve_status=Session::get('approve_status');
        $langid=Session::get('language_id')??1;
        
		$lists = Circular::query()
            ->leftJoin('corrigendums', 'circulars.id', '=', 'corrigendums.parent_id')
            ->select('circulars.*', DB::raw('MAX(corrigendums.parent_id)'), DB::raw('MAX(corrigendums.title) as cor_title'), DB::raw('MAX(corrigendums.txtuplode) as cor_file'), DB::raw('MAX(corrigendums.type) as cor_type'));

        if (!empty($sertitle)) {
            $lists->where('title', 'LIKE', "%{$sertitle}%");
        }
        if (!empty($circularstype)) {
            $lists->where('circularstype',$circularstype);
        }
        if (!empty($approve_status)) {
            $lists->where('txtstatus',$approve_status);
        }
        if (!empty($language_id)) {
            $lists->where('language',$language_id);
        }
        $list=$lists->groupBy('circulars.id', 'circulars.title', 'circulars.url', 'circulars.page_url','circulars.is_new','circulars.language','circulars.circularstype','circulars.menutype','circulars.metakeyword','circulars.metadescription','circulars.description','circulars.txtuplode','circulars.txtuplode','circulars.txtweblink','circulars.txtstatus','circulars.admin_id','circulars.startdate','circulars.enddate','circulars.created_at','circulars.updated_at')->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin/recruitment/index',compact(['list','langid','title']));
    }

    /**
     * Show the form for creating a new Recruitment.
     */
    public function create()
    {
       $title="Add Recruitment";
        
       return view('admin/recruitment/add',compact(['title']));
    }

    /**
     * Store a newly created Recruitment in storage.
     */
    public function store(Request $request){ 

        if(isset($request->search)){
            $Mtitle=clean_single_input(trim($request->title));
            $approve_status=clean_single_input($request->approve_status);
            $circularstype=clean_single_input($request->circularstype);
            $language_id=clean_single_input($request->language_id);
            Session::put('Mtitle', $Mtitle);
            Session::put('approve_status', $approve_status);
            Session::put('circularstype', $circularstype);
            Session::put('language_id', $language_id);
            return redirect('admin/recruitment');
        }

       $txtuplode1 ='';
       $rules = array(
           'recruitment_type' => 'required',
           'language' => 'required',
		   'title' => 'required|regex:/^[\p{Devanagari}a-zA-Z0-9 ,()\'"\\/.&-]+$/u',
           //'title' => 'required',
        //    'url' => 'required',
           'menutype' => 'required',
           'txtstatus' => 'required',
           'is_new' => 'required',
           'startdate' => 'required',
           'enddate' => 'required'
       );
       $valid
       =array(
            'menutype.required'=>'Menu type field  is required',
            'url.required'=>'Page url field  is required',
            'startdate.required'=>'Start date  field  is required',
            'enddate.required'=>'End date  field  is required',
            'txtstatus.required' =>'Pages Status field is required',
			'title.regex' => 'The title may only contain Hindi, English letters, numbers, spaces and Some Special Characters.',
       );
       $validator = '';
       if($request->menutype == 1){
           $rules = array(
               'description' => 'required',
               'metakeyword' => 'required',
               'metadescription' => 'required'
           );
            
           $validator = Validator::make($request->all(), $rules. $valid);
       }elseif($request->menutype == 2){
          if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/circulars/')) {
                mkdir('public/upload/admin/cmsfiles/circulars/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
			   
			   $clean_title = str_replace([' / ',', ',' ,',' , ','. ',' .',' . ',' & ','(',')','/', ',', '.','&'], '', $request->title);
               $txtuplode1 = str_replace(' ','_',clean_single_input($clean_title)).'_circulars'.'.'.$request->txtuplode->extension(); 
               //$txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_circulars'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/circulars/'), $txtuplode1);
              
               
                if($res){
                   $txtuplode1 =$txtuplode1;
                }
                $txtuplode2 ='upload/admin/cmsfiles//circulars/'.$txtuplode1; //die();
                
                if (file_exists($txtuplode2)) {
                    unlink($txtuplode2);
                }
                 $validator = Validator::make($request->all(), $rulesdsad);
          }
       }elseif($request->menutype == 3){
           $rules = array(
               'txtweblink' => 'required'
           );
              
           $validator = Validator::make($request->all(), $rules);
       }
       $validator = Validator::make($request->all(), $rules, $valid);
       
       if ($validator->fails()) {
        return  back()->withErrors($validator)->withInput();
           
       }else{
           $user_login_id=Auth()->user()->id;
           
           $pArray['circularstype']    			    = clean_single_input($request->recruitment_type);
           $pArray['title']    			        	= clean_single_input($request->title); 
           $pArray['url']    					    = Str::slug(clean_single_input($request->url));// clean_single_input(seo_url($request->title)); 
		   $pArray['page_url']                      = clean_single_input(seo_url($request->title));
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['menutype']  					= clean_single_input($request->menutype); 
           $pArray['metakeyword']    			    = clean_single_input($request->metakeyword); 
           $pArray['metadescription']				= clean_single_input($request->metadescription); 
           $pArray['description']    				= clean_single_input($request->description); 
           $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
           $pArray['txtweblink']    				= clean_single_input($request->txtweblink); 
           $pArray['admin_id']  					= clean_single_input($user_login_id); 
           $pArray['startdate']  			        = date("Y-m-d ", strtotime(clean_single_input($request->startdate)));
		   $pArray['enddate']  			            = date("Y-m-d ", strtotime(clean_single_input($request->enddate)));
           $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           $create 	= Circular::create($pArray);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
            'page_id'           	=>  $lastInsertID,
            'page_name'             =>  clean_single_input($request->title),
            'page_action'           =>  'Insert',
            'page_category'         =>  clean_single_input($request->menutype),
            'lang'                  =>  clean_single_input($request->language),
            'page_title'        	=> $request->recruitment_type ? 'Circulars' : 'Vacancies',
            'approve_status'        => clean_single_input($request->txtstatus),
            'usertype'          	=> 'Admin'
        );
                           
               audit_trail($audit_data);
               return redirect('admin/recruitment')->with('success','Recruitment has successfully added');
           }
          
       }
    }

    /**
     * Display the specified Recruitment.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified Recruitment.
     */
    public function edit(string $id)
    {
        $title="Edit Recruitment ";
        $id=clean_single_input($id);
        $data = Circular::find($id);
        return view('admin/recruitment/edit',compact(['title','data']));
    }

    /**
     * Update the specified Recruitment in storage.
     */
    public function update(Request $request, string $id)
    {
        $id=  clean_single_input($id);
       $txtuplode1 ='';
       $rules = array(
           'recruitment_type' => 'required',
           'language' => 'required',
           //'title' => 'required',
		   'title' => 'required|regex:/^[\p{Devanagari}a-zA-Z0-9 ,()\'"\\/.&-]+$/u',
        //    'url' => 'required',
           'menutype' => 'required',
           'txtstatus' => 'required',
           'is_new' => 'required',
           'startdate' => 'required',
           'enddate' => 'required'
       );
       $valid
       =array(
            'menutype.required'=>'Menu type field  is required',
            'url.required'=>'Page url field  is required',
            'startdate.required'=>'Start date  field  is required',
            'enddate.required'=>'End date  field  is required',
            'txtstatus.required' =>'Pages Status field is required',
			'title.regex' => 'The title may only contain Hindi, English letters, numbers, spaces and Some Special Characters.',
       );
       $validator = '';
       if($request->menutype == 1){
           $rules = array(
               'description' => 'required',
               'metakeyword' => 'required',
               'metadescription' => 'required'
           );
            
           $validator = Validator::make($request->all(), $rules);
       }elseif($request->menutype == 2){

           if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/circulars/')) {
                mkdir('public/upload/admin/cmsfiles/circulars/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
			   
			   $clean_title = str_replace([' / ',', ',' ,',' , ','. ',' .',' . ',' & ','(',')','/', ',', '.','&'], '', $request->title);
               $txtuplode1 = str_replace(' ','_',clean_single_input($clean_title)).'_circulars'.'.'.$request->txtuplode->extension(); 
               //$txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_circulars'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/circulars/'), $txtuplode1);
              
               
                  if($res){
                    $txtuplode1 =$txtuplode1;
                  }
                $txtuplode2 ='upload/admin/cmsfiles//circulars/'.$txtuplode1; //die();

                if (file_exists($txtuplode2)) {
                    unlink($txtuplode2);
                }
                 $validator = Validator::make($request->all(), $rulesdsad);
           }else{
            $txtuplode1 =$request->olduplode;
           }
       }elseif($request->menutype == 3){
        
           $rules = array(
               'txtweblink' => 'required'
           );
              
           $validator = Validator::make($request->all(), $rules);
       }
        $validator = Validator::make($request->all(), $rules ,$valid);
       
       if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
       }else{
           $user_login_id=Auth()->user()->id;
          
           $pArray['circularstype']    			    = clean_single_input($request->recruitment_type);
           $pArray['title']    				        = clean_single_input($request->title); 
           $pArray['url']    					    = Str::slug(clean_single_input($request->url)); // clean_single_input(seo_url($request->title)); 
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['menutype']  					= clean_single_input($request->menutype); 
           if($request->menutype == 1){
               $pArray['txtuplode']  				    = ''; 
               $pArray['txtweblink']    				= '';
               $pArray['metakeyword']    			    = clean_single_input($request->metakeyword); 
               $pArray['metadescription']				= clean_single_input($request->metadescription); 
            }elseif($request->menutype == 2){
                $pArray['metakeyword']    			    = ''; 
                $pArray['metadescription']				= ''; 
                $pArray['txtweblink']    				= ''; 
                $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
                
           }elseif($request->menutype == 3){
            $pArray['metakeyword']    			    = ''; 
            $pArray['metadescription']				= ''; 
            $pArray['txtuplode']    				= ''; 
            $pArray['txtweblink']  				    = clean_single_input($request->txtweblink); 
           }else{

           }
          
           $pArray['description']    				= clean_single_input($request->description); 
           $pArray['admin_id']  					= clean_single_input($user_login_id); 
           $pArray['startdate']  			        = date("Y-m-d ", strtotime(clean_single_input($request->startdate)));
		   $pArray['enddate']  			            = date("Y-m-d ", strtotime(clean_single_input($request->enddate)));
           $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 
           $pArray['page_url']  		            = clean_single_input(seo_url($request->title));
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           $user_login_id=Auth()->user()->id;

           $create 	= Circular::where('id', $id)->update($pArray);
           if($create > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'           	=>  $id,
                    'page_name'             =>  clean_single_input($request->title),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->menutype),
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'        	=> $request->recruitment_type ? 'Circulars' : 'Vacancies',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'          	=> 'Admin'
                );
                           
               audit_trail($audit_data);
               return redirect('admin/recruitment')->with('success','Recruitment has successfully Updated');
           }
          
       }
    }

    /**
     * Remove the specified Recruitment from storage.
     */
    public function destroy(Circular $Circular,$id)
    {
	  $data = Circular::find($id);
      $delete= $data->delete();
	  
	  Corrigendum::where('parent_id',$data->id)->where('type',2)->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $data->id,
                            'page_name'             =>  clean_single_input($data->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($data->language),
                            'page_title'        	=> $data->recruitment_type ? 'Circulars' : 'Vacancies',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/recruitment')->with('success','Recruitment deleted successfully');
        }
       
     }
}
