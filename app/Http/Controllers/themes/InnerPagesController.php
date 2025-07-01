<?php

namespace App\Http\Controllers\themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Menu;
use App\Models\admin\Tender;
use App\Models\admin\Corrigendum;
use App\Models\admin\Circular;
use App\Models\admin\Officer;
use App\Models\admin\Photogallery;
use App\Models\admin\Faq;
use App\Models\admin\Podcast;
use App\Models\admin\Videogallerys;
use App\Models\admin\Whatsnew;
use App\Models\admin\MinistersInfo;
use App\Models\admin\PressRelease;
use App\Models\admin\Logo;
use App\Models\admin\Guideline;
use App\Models\admin\ConsumerProduct;
use Illuminate\Support\Facades\Storage;
use App\Models\admin\SuccessStory;

class InnerPagesController extends Controller
{
    public function index($slug="",Request $request)
    {   
        $slug= clean_single_input($slug);
        
        $title=''; $id='';$m_flag_id=''; $m_url='';$chtitle='';$data='';
        $langid=session()->get('locale')??1;
        // dd($langid);
        if($slug=="login"){
            $title="Login";
            $data="Data";
            return response()->view('auth/login', compact( 'data','title'));
        }
        if($slug=='home'){
            return redirect('/');  
        }
        
       
        $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_id','m_type','m_flag_id','menu_positions','language_id','m_name','m_url','m_title','m_keyword','m_description','content','doc_uplode','linkstatus','approve_status','page_postion','welcomedescription')->first();
        
        if(!empty($data)){
            $title=$data->m_name;
            $m_url=$data->m_url;
            $id=$data->id;
            $data1 =  Menu::where('id', $id)->where('language_id', $langid)->where('approve_status',3)->select('id','m_id','m_type','m_flag_id','menu_positions','language_id','m_name','m_url','m_title','m_keyword','m_description','content','doc_uplode','linkstatus','approve_status','page_postion','welcomedescription')->first();
            if(!empty($data1)){
                $m_flag_id=$data1->m_flag_id;
                $chtitle=$data1->title;
            }
            if($slug==='feedback'){
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/feedback", compact( 'data','title','id','m_flag_id','m_url','chtitle'));
 
            }
            if($slug=='site-map'){
               // $title="Site Map";
                $data="Data";
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/siteMaps", compact( 'data','title','id','m_flag_id','m_url'));
            }

            if($slug=='user-guidelines'){
                $title="User Guideline";
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $guideline = Guideline::where('language', $langid)->where('txtstatus',3);

                if (!empty($request->keywords)) {
                    $menu_title=clean_single_input($request->keywords);
                    $guideline->where('menu_title',  'LIKE', "%{$menu_title}%" );
                }
                $guideline=$guideline->orderby('created_at','DESC')->paginate(10);
    
                // dd($guideline);
                
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/guidelines", compact( 'data','guideline','title','id','m_flag_id','m_url'));
        
            }

            if($slug == 'social-media'){
                $title = "Social Media";
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/socialmedia", compact('title','id','m_flag_id','m_url'));
            }
            // if($slug=='photo-gallery'){
            //    $title="Photo Gallery";
            //    $data=Photogallery::where('language', $langid)->paginate(10);
            //     $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
            //     return response()->view("themes/{$themes}/innerpagesPhoto", compact( 'data','title','id','m_flag_id','m_url'));
            // }
            if($slug=='photo-gallery'){
                // $title="Photo Gallery";
                $keywords = $request->keywords;
                $startdate = $request->startdate;
                
                $query=Photogallery::where('language', $langid)->where('txtstatus', 3);
                if($keywords){
                    $query->where('title', 'LIKE', '%' . $keywords . '%');
                }
                if($startdate){
                    $query->whereDate('eventdate', $startdate);
                }

                $data = $query->orderBy('eventdate', 'DESC')->paginate(10);
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/innerpagesPhoto", compact( 'startdate','keywords','data','title','id','m_flag_id','m_url'));
            }
            if($slug == 'video-gallery'){
                // $title = "Video Gallery";
                $keywords = $request->keywords;
                $startdate = $request->startdate;
                
                $query=Videogallerys::where('language', $langid);
                if($keywords){
                    $query->where('title', 'LIKE', '%' . $keywords . '%');
                }
                if($startdate){
                    $query->whereDate('created_at', $startdate);
                }

                $data = $query->paginate(10);

                if(!empty($data)){
                    foreach($data as $video_id){
                        $videoUrl = $video_id->txtuplode;
                        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);
                        $video_id->video_id = $query['v'] ?? null;
                    }
                }

                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/videoGallery", compact( 'startdate','keywords','data','title','id','m_flag_id','m_url'));

            }
            if($slug == 'important-link'){
                // $title = "Important Link";
                $importantLink = Logo::where('txtstatus',3)->where('language',$langid)->where('txttype',2)->get();
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/importantlink", compact('importantLink','title','id','m_flag_id','m_url'));
            }
            if($slug == 'rap-songs'){
                // $title="Rap Songs";
                $keywords = $request->keywords;
                $startdate = $request->startdate;
                
                $query=Podcast::where('language', $langid);
                if($keywords){
                    $query->where('title', 'LIKE', '%' . $keywords . '%');
                }
                if($startdate){
                    $query->whereDate('created_at', $startdate);
                }

                // $data=Photogallery::where('language', $langid)->paginate(10);
                $data = $query->paginate(10);
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/rapsong", compact( 'startdate','keywords','data','title','id','m_flag_id','m_url'));
            }
            
            if($slug == 'latest-news'){
                
                // $title="Latest News";
                $keywords = $request->keywords;
                $startdate = $request->startdate;
                $enddate = $request->enddate;

                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                
                $query=Whatsnew::where('language', $langid)->where('enddate','>' ,$today)->where('txtstatus',3);
                if($keywords){
                    $query->where('title', 'LIKE', '%' . $keywords . '%');
                }
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $startdate = clean_single_input($request->startdate);
                    $enddate = clean_single_input($request->enddate);
                    $query->whereBetween('startdate', [$startdate, $enddate]);
                } else {
                    if (!empty($request->startdate)) {
                        $query->where('startdate', '>=', clean_single_input($request->startdate));
                    }
                    
                    if (!empty($request->enddate)) {
                        $query->where('startdate', '<=', clean_single_input($request->enddate));
                    }
                }

                $searchInputs = [
                    "keywords" => $keywords,
                    "startdate" => $startdate,
                    "enddate" => $enddate
                ];

                // $data=Photogallery::where('language', $langid)->paginate(10);
                $data = $query->orderBy('startdate','DESC')->paginate(10);

                foreach ($data as $list) {
                    
                    if (!empty($list->txtuplode)) {
                        $filePath = public_path('/upload/admin/cmsfiles/whatsnews/' . $list->txtuplode);
                        // dd($filePath);
                
                        if (file_exists($filePath)) {
                            $sizeInKB = round(filesize($filePath) / 1024, 2);
                            $list->file_size = round($sizeInKB / 1024, 2) > 1 ?  round($sizeInKB / 1024, 2) . " MB" : $sizeInKB . " KB";

                            $mimeType = mime_content_type($filePath);
                            $list->is_pdf = ($mimeType === 'application/pdf') ? true : false;
                        } else {
                            $list->file_size = "File not found! ";
                        }
                    }
                }

                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/whatsNew", compact('data','title','id','m_flag_id','m_url','searchInputs'));
            }
            if($slug == 'whos-who'){
                // $title = "Whos who";
                $name= $request->name;
                $email= $request->email;

                // dd($request->resetsubmit);
                if($request->resetsubmit){
                    // dd($request->resetsubmit);
                    $name = '';
                    $email = '';
                }

                $query=MinistersInfo::where('language', $langid)->where('txtstatus',3);
                if($name){
                    $query->where('name', 'LIKE', '%' . $name . '%');
                }
                if($email){
                    $query->where('email', 'LIKE', '%' . $email . '%');
                }
                //$data = $query->orderBy('ministers_type','ASC')->orderBy('created_at','ASC')->get()->groupBy('ministers_type');
				
				$data = $query->orderBy('ministers_type','ASC')->orderByRaw('CASE 
                WHEN info_position IS NULL THEN 1 
                WHEN info_position = 0 THEN 1 
                ELSE 0 
                END ASC')->orderBy('info_position', 'ASC')->get()->groupBy('ministers_type');

                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/ministersInfo", compact( 'data','title','id','m_flag_id','m_url','name','email','langid'));
            }

            if($slug == 'press-release'){
                $keywords = $request->keywords;
                $startdate = $request->startdate;
                $enddate = $request->enddate;
                
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));

                $pressRelease = PressRelease::where('end_date','>' ,$today)->where('language', $langid)->where('txtstatus',3);
               
                if (!empty($request->keywords)) {
                    $pressRelease->where('title',  'LIKE', '%' . $keywords . '%' );
                }
                // if (!empty($request->startdate)) {
                //     $pressRelease->where('start_date', clean_single_input($request->startdate));
                // }
                // if (!empty($request->enddate)) {
                //     $pressRelease->where('end_date', clean_single_input($request->enddate));
                // }
                // if (!empty($request->startdate) && !empty($request->enddate)) {
                //     $pressRelease->whereBetween('start_date',[
                //         clean_single_input($request->startdate),
                //         clean_single_input($request->enddate)
                //     ]);
                // }

                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $startdate = clean_single_input($request->startdate);
                    $enddate = clean_single_input($request->enddate);
                    $pressRelease->whereBetween('start_date', [$startdate, $enddate]);
                } else {
                    if (!empty($request->startdate)) {
                        $pressRelease->where('start_date', '>=', clean_single_input($request->startdate));
                    }
                    
                    if (!empty($request->enddate)) {
                        $pressRelease->where('start_date', '<=', clean_single_input($request->enddate));
                    }
                }

                $pressRelease=$pressRelease->orderby('start_date','DESC')->paginate(10);

                foreach ($pressRelease as $list) {
                    
                    if (!empty($list->txtuplode)) {
                        $filePath = public_path('/upload/admin/cmsfiles/pressRelease/' . $list->txtuplode);
                        // dd($filePath);
                
                        if (file_exists($filePath)) {
                            $sizeInKB = round(filesize($filePath) / 1024, 2);
                            $list->file_size = round($sizeInKB / 1024, 2) > 1 ?  round($sizeInKB / 1024, 2) . " MB" : $sizeInKB . " KB";

                            $mimeType = mime_content_type($filePath);
                            $list->is_pdf = ($mimeType === 'application/pdf') ? true : false;
                        } else {
                            $list->file_size = "File not found! ";
                        }
                    }
                }

                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/pressrelease", compact( 'pressRelease','data','title','id','m_flag_id','m_url','keywords','startdate','enddate'));
            }
			
			
            if($slug == 'nch-resources'){
                // $title = "Important Link";
                 $ejagrati = SuccessStory::where('txtstatus',3)->where('language',$langid)->where('storytype',2)->get();
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/nchResources", compact('ejagrati','title','id','m_flag_id','m_url'));
            }

           if($slug == 'e-jagriti'){
                // $title = "Important Link";
                 $jagrati = SuccessStory::where('txtstatus',3)->where('language',$langid)->where('storytype',1)->get();
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/ejagritiResources", compact('jagrati','title','id','m_flag_id','m_url'));
            }

            if($slug=='faqs'){
               
                 $datas= Faq::where('language', $langid)->where('txtstatus',3)->orderby('updated_at','DESC')->select('id','title','url','admin_id', 'page_url','category','language','description','txtstatus')->paginate(100);
          
                 $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
               
                return response()->view("themes/{$themes}/faqspages", compact( 'datas','title','id','m_flag_id','m_url'));
             }

            $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
            // if($slug=='tenders' || $slug=='published-tenders' || $slug=='property-development-business'|| $slug=='gcc-other-guidelines'){
            if($slug=='tenders'){
                //$title="Tender";
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $tender = Tender::where('end_date','>' ,$today)->where('language', $langid)->where('txtstatus',3);
               
                // if($slug=='property-development-business'){
                //     $tender->where('tendertype', 1);
                // }
                // if($slug=='gcc-other-guidelines'){
                //     $tender->where('tendertype', 2);
                // }
                if (!empty($request->keywords)) {
                    $tender_title=clean_single_input($request->keywords);
                    $tender->where('tender_title',  'LIKE', "%{$tender_title}%" );
                }
                if (!empty($request->startdate)) {
                    $tender->where('start_date', clean_single_input($request->startdate));
                }
                if (!empty($request->enddate)) {
                    $tender->where('end_date', clean_single_input($request->enddate));
                }
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $tender->where('start_date', clean_single_input($request->startdate));
                }
                $tenders=$tender->orderby('start_date','DESC')->paginate(10);

                foreach ($tenders as $list) {
                    
                    if (!empty($list->txtuplode)) {
                        $filePath = public_path('/upload/admin/cmsfiles/tenders/' . $list->txtuplode);
                        // dd($filePath);
						
						$list->corrigendums = Corrigendum::where('parent_id', $list->id)
                            ->where('type', 1)
                            ->get();
                
                        if (file_exists($filePath)) {
                            $sizeInKB = round(filesize($filePath) / 1024, 2);
                            $list->file_size = round($sizeInKB / 1024, 2) > 1 ?  round($sizeInKB / 1024, 2) . " MB" : $sizeInKB . " KB";

                            $mimeType = mime_content_type($filePath);
                            $list->is_pdf = ($mimeType === 'application/pdf') ? true : false;
                        } else {
                            $list->file_size = "File not found! ";
                        }
                    }
                }
    
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/tender", compact( 'data','tenders','title','id','m_flag_id','m_url','chtitle'));
        
            }
            if($slug==='archived-tenders'){
              //  $title="Archived Tenders";
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $tender = Tender::where('end_date','<' ,$today)->where('txtstatus',3)->where('language', $langid);
                if (!empty($request->keywords)) {
                    $tender_title=clean_single_input($request->keywords);
                    $tender->where('tender_title',  'LIKE', "%{$tender_title}%" );
                }
                if (!empty($request->startdate)) {
                    $tender->where('start_date', clean_single_input($request->startdate));
                }else
                if (!empty($request->enddate)) {
                    $tender->where('end_date', clean_single_input($request->enddate));
                }else
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $tender->where('start_date', clean_single_input($request->startdate));
                }
                $tenders=$tender->orderby('start_date','DESC')->select('tender_title','language','tendertype','url','txtuplode','txtweblink','start_date','end_date')->paginate(10);
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/tender", compact( 'data','tenders','title','id','m_flag_id','m_url','chtitle'));
        
            }

            if($slug=='circulars'){
                //$title="Circular";
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $circular = Circular::where('language', $langid)->where('enddate','>' ,$today)->where('txtstatus',3)->where('circularstype', '1');

                if (!empty($request->keywords)) {
                    $circular_title=clean_single_input($request->keywords);
                    $circular->where('title',  'LIKE', "%{$circular_title}%" );
                }
                if (!empty($request->startdate)) {
                    $circular->where('startdate', clean_single_input($request->startdate));
                }
                if (!empty($request->enddate)) {
                    $circular->where('enddate', clean_single_input($request->enddate));
                }
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $circular->where('startdate', clean_single_input($request->startdate));
                }
                $circulars=$circular->orderby('startdate','DESC')->paginate(10);
                
                foreach ($circulars as $circular) {
                    
                    if (!empty($circular->txtuplode)) {
                        $filePath = public_path('/upload/admin/cmsfiles/circulars/' . $circular->txtuplode);
                        // dd($filePath);
                
                        if (file_exists($filePath)) {
                            $sizeInKB = round(filesize($filePath) / 1024, 2);
                            $circular->file_size = round($sizeInKB / 1024, 2) > 1 ?  round($sizeInKB / 1024, 2) . " MB" : $sizeInKB . " KB";

                            $mimeType = mime_content_type($filePath);
                            $circular->is_pdf = ($mimeType === 'application/pdf') ? true : false;
                        } else {
                            $circular->file_size = "File not found! ";
                        }
                    }
                }

    
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/circular", compact( 'data','circulars','title','id','m_flag_id','m_url','chtitle'));
        
            }

            if($slug=='vacancy'){
                //$title="Vacancy";
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $vacancy = Circular::where('enddate','>' ,$today)->where('language', $langid)->where('txtstatus',3)->where('circularstype', '2');
                

                if (!empty($request->keywords)) {
                    $vacancy_title=clean_single_input($request->keywords);
                    $vacancy->where('title',  'LIKE', "%{$vacancy_title}%" );
                }
                if (!empty($request->startdate)) {
                    $vacancy->where('startdate', clean_single_input($request->startdate));
                }
                if (!empty($request->enddate)) {
                    $vacancy->where('enddate', clean_single_input($request->enddate));
                }
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $vacancy->where('startdate', clean_single_input($request->startdate));
                }
                $vacancy=$vacancy->orderby('startdate','DESC')->paginate(10);

                foreach ($vacancy as $list) {
                    
                    if (!empty($list->txtuplode)) {
                        $filePath = public_path('/upload/admin/cmsfiles/circulars/' . $list->txtuplode);
                        // dd($filePath);
						
						$list->corrigendums = Corrigendum::where('parent_id', $list->id)
                            ->where('type', 2)
                            ->get();
                
                        if (file_exists($filePath)) {
                            $sizeInKB = round(filesize($filePath) / 1024, 2);
                            $list->file_size = round($sizeInKB / 1024, 2) > 1 ?  round($sizeInKB / 1024, 2) . " MB" : $sizeInKB . " KB";

                            $mimeType = mime_content_type($filePath);
                            $list->is_pdf = ($mimeType === 'application/pdf') ? true : false;
                        } else {
                            $list->file_size = "File not found! ";
                        }
                    }
                }
    
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/vacancy", compact( 'data','vacancy','title','id','m_flag_id','m_url','chtitle'));
        
            }

            if($slug=='downloadss'){
                //$title="Vacancy";
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $vacancy = Circular::where('enddate','>' ,$today)->where('language', $langid)->where('txtstatus',3);

                if (!empty($request->keywords)) {
                    $vacancy_title=clean_single_input($request->keywords);
                    $vacancy->where('title',  'LIKE', "%{$vacancy_title}%" );
                }
                if (!empty($request->startdate)) {
                    $vacancy->where('startdate', clean_single_input($request->startdate));
                }
                if (!empty($request->enddate)) {
                    $vacancy->where('enddate', clean_single_input($request->enddate));
                }
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $vacancy->where('startdate', clean_single_input($request->startdate));
                }
                $vacancy=$vacancy->where('circularstype', '4')->orderby('startdate','DESC')->select('title','description','language','circularstype','url','txtuplode','txtweblink','startdate','enddate')->paginate(10);
    
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/announcementDownloads", compact( 'data','vacancy','title','id','m_flag_id','m_url','chtitle'));
        
            }

            if($slug=='archiveall'){

                $keywords = $request->keywords;
                $startdate = $request->startdate;
                $enddate = $request->enddate;
                $archiveType = $request->archiveType;
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $validArchiveTypes = ['tender', 'circular', 'vacancy', 'press_release', 'latest_news'];

                if(!empty($archiveType) && in_array($archiveType, $validArchiveTypes)){
                    if($archiveType == 'circular'){
                        $archive = Circular::where('enddate','<' ,$today)->where('txtstatus',3)->where('language', $langid)->where('circularstype','1');

                        if (!empty($keywords)) {
                            $archive_title=clean_single_input($keywords);
                            $archive->where('title',  'LIKE', "%{$archive_title}%" );
                        }
                        if (!empty($request->startdate) && !empty($request->enddate)) {
                            $startdate = clean_single_input($request->startdate);
                            $enddate = clean_single_input($request->enddate);
                            $archive->whereBetween('startdate', [$startdate, $enddate]);
                        } else {
                            if (!empty($request->startdate)) {
                                $archive->where('startdate', '>=', clean_single_input($request->startdate));
                            }
                            
                            if (!empty($request->enddate)) {
                                $archive->where('startdate', '<=', clean_single_input($request->enddate));
                            }
                        }
                        
                        $archive_data=$archive->orderby('startdate','DESC')->paginate(10);
                    }

                    if($archiveType == "vacancy"){
                        $archive = Circular::where('enddate','<' ,$today)->where('txtstatus',3)->where('language', $langid)->where('circularstype','2');

                        if (!empty($keywords)) {
                            $archive_title=clean_single_input($keywords);
                            $archive->where('title',  'LIKE', "%{$archive_title}%" );
                        }
                        if (!empty($request->startdate) && !empty($request->enddate)) {
                            $startdate = clean_single_input($request->startdate);
                            $enddate = clean_single_input($request->enddate);
                            $archive->whereBetween('startdate', [$startdate, $enddate]);
                        } else {
                            if (!empty($request->startdate)) {
                                $archive->where('startdate', '>=', clean_single_input($request->startdate));
                            }
                            
                            if (!empty($request->enddate)) {
                                $archive->where('startdate', '<=', clean_single_input($request->enddate));
                            }
                        }
                        
                        $archive_data=$archive->orderby('startdate','DESC')->paginate(10);
						
						foreach ($archive_data as $list) {
                                $list->corrigendums = Corrigendum::where('parent_id', $list->id)
                                    ->where('type', 2)
                                    ->get();
                        }
                    }

                    if($archiveType == "tender"){
                        $archive = Tender::where('end_date','<' ,$today)->where('language', $langid)->where('txtstatus',3);
                        // dd($archive);
                    
                        if (!empty($request->keywords)) {
                            $tender_title=clean_single_input($request->keywords);
                            $archive->where('tender_title',  'LIKE', "%{$tender_title}%" );
                        }
                        if (!empty($request->startdate) && !empty($request->enddate)) {
                            $startdate = clean_single_input($request->startdate);
                            $enddate = clean_single_input($request->enddate);
                            $archive->whereBetween('start_date', [$startdate, $enddate]);
                        } else {
                            if (!empty($request->startdate)) {
                                $archive->where('start_date', '>=', clean_single_input($request->startdate));
                            }
                            
                            if (!empty($request->enddate)) {
                                $archive->where('start_date', '<=', clean_single_input($request->enddate));
                            }
                        }
                        $archive_data=$archive->orderby('start_date','DESC')->paginate(10);
						
						foreach ($archive_data as $list) {
                            $list->corrigendums = Corrigendum::where('parent_id', $list->id)
                                ->where('type', 1)
                                ->get();
                        }
                    }

                    if($archiveType == "press_release"){
                        $archive = PressRelease::where('end_date','<=' ,$today)->where('language', $langid)->where('txtstatus',3);
                    
                        if (!empty($request->keywords)) {
                            $press_title=clean_single_input($request->keywords);
                            $archive->where('title',  'LIKE', "%{$press_title}%" );
                        }
                        if (!empty($request->startdate) && !empty($request->enddate)) {
                            $startdate = clean_single_input($request->startdate);
                            $enddate = clean_single_input($request->enddate);
                            $archive->whereBetween('start_date', [$startdate, $enddate]);
                        } else {
                            if (!empty($request->startdate)) {
                                $archive->where('start_date', '>=', clean_single_input($request->startdate));
                            }
                            
                            if (!empty($request->enddate)) {
                                $archive->where('start_date', '<=', clean_single_input($request->enddate));
                            }
                        }
                        $archive_data=$archive->orderby('start_date','DESC')->paginate(10);
                    }

                    if($archiveType == "latest_news"){
                        $archive = Whatsnew::where('enddate','<' ,$today)->where('language', $langid)->where('txtstatus',3);
                    
                        if (!empty($request->keywords)) {
                            $latest_news_title=clean_single_input($request->keywords);
                            $archive->where('title',  'LIKE', "%{$latest_news_title}%" );
                        }
                        if (!empty($request->startdate) && !empty($request->enddate)) {
                            $startdate = clean_single_input($request->startdate);
                            $enddate = clean_single_input($request->enddate);
                            $archive->whereBetween('startdate', [$startdate, $enddate]);
                        } else {
                            if (!empty($request->startdate)) {
                                $archive->where('startdate', '>=', clean_single_input($request->startdate));
                            }
                            
                            if (!empty($request->enddate)) {
                                $archive->where('startdate', '<=', clean_single_input($request->enddate));
                            }
                        }
                        $archive_data=$archive->orderby('startdate','DESC')->paginate(10);
                    }

                }else{
                    $archive = Tender::where('end_date','<' ,$today)->where('language', $langid)->where('txtstatus',3);
                    
                        if (!empty($request->keywords)) {
                            $tender_title=clean_single_input($request->keywords);
                            $tender->where('tender_title',  'LIKE', "%{$tender_title}%" );
                        }
                        if (!empty($request->startdate) && !empty($request->enddate)) {
                            $startdate = clean_single_input($request->startdate);
                            $enddate = clean_single_input($request->enddate);
                            $archive->whereBetween('start_date', [$startdate, $enddate]);
                        } else {
                            if (!empty($request->startdate)) {
                                $archive->where('start_date', '>=', clean_single_input($request->startdate));
                            }
                            
                            if (!empty($request->enddate)) {
                                $archive->where('start_date', '<=', clean_single_input($request->enddate));
                            }
                        }
                    $archive_data=$archive->orderby('start_date','DESC')->paginate(10);
					
					foreach ($archive_data as $list) {
						$list->corrigendums = Corrigendum::where('parent_id', $list->id)
							->where('type', 1)
							->get();
					}
                }
                
                // $todate=date('Y-m-d');
                // $today= date("Y-m-d", strtotime($todate));
                // $circular = Circular::where('enddate','<' ,$today)->where('language', $langid)->where('txtstatus',3);
                // $tender = Tender::where('end_date','<' ,$today)->where('txtstatus',3)->where('language', $langid);

                // if (!empty($request->keywords)) {
                //     $circular_title=clean_single_input($request->keywords);
                //     $circular->where('title',  'LIKE', "%{$circular_title}%" );

                //     $tender_title=clean_single_input($request->keywords);
                //     $tender->where('tender_title',  'LIKE', "%{$tender_title}%" );
                // }
                // if (!empty($request->startdate)) {
                //     $circular->where('startdate', clean_single_input($request->startdate));
                //     $tender->where('start_date', clean_single_input($request->startdate));
                // }
                // if (!empty($request->enddate)) {
                //     $circular->where('enddate', clean_single_input($request->enddate));
                //     $tender->where('end_date', clean_single_input($request->enddate));
                // }
                // if (!empty($request->startdate) && !empty($request->enddate)) {
                //     $circular->where('startdate', clean_single_input($request->startdate));
                //     $tender->where('start_date', clean_single_input($request->startdate));
                // }

                // $circular=$circular->orderby('startdate','DESC')->select('title','description','language','circularstype','url','txtuplode','txtweblink','startdate','enddate');
                // $tenders=$tender->orderby('start_date','DESC')->select('tender_title','description','language','tendertype','url','txtuplode','txtweblink','start_date','end_date');
    
                // $archive = $circular->union($tenders)
                //     ->paginate(10);


                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/archiveall", compact( 'data','archive_data','keywords','startdate','enddate','archiveType','title','id','m_flag_id','m_url','chtitle'));
        
            }
			
			if($slug == 'consumer-products'){
                $consumer_product = ConsumerProduct::where('language', $langid)->where('status',3)->where('type',1);
                if (!empty($request->keywords)) {
                    $title=clean_single_input($request->keywords);
                    $consumer_product->where('title',  'LIKE', "%{$title}%" );
                }
                $consumer_products = $consumer_product->orderby('created_at','DESC')->paginate(10);
                foreach ($consumer_products as $list) {
                    
                    if (!empty($list->txtuplode)) {
                        $filePath = public_path('/upload/admin/cmsfiles/consumer_products/' . $list->txtuplode);
                        // dd($filePath);
                
                        if (file_exists($filePath)) {
                            $sizeInKB = round(filesize($filePath) / 1024, 2);
                            $list->file_size = round($sizeInKB / 1024, 2) > 1 ?  round($sizeInKB / 1024, 2) . " MB" : $sizeInKB . " KB";

                            $mimeType = mime_content_type($filePath);
                            $list->is_pdf = ($mimeType === 'application/pdf') ? true : false;
                        } else {
                            $list->file_size = "File not found! ";
                        }
                    }
                }

                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/consumerProduct", compact( 'data','consumer_products','title','id','m_flag_id','m_url','chtitle'));
            }

            if($slug == 'consumer-association'){
                $consumer_association = ConsumerProduct::where('language', $langid)->where('status',3)->where('type',2);
                if (!empty($request->keywords)) {
                    $title=clean_single_input($request->keywords);
                    $consumer_association->where('title',  'LIKE', "%{$title}%" );
                }
                $consumer_associations = $consumer_association->orderby('created_at','DESC')->paginate(10);
                foreach ($consumer_associations as $list) {
                    
                    if (!empty($list->txtuplode)) {
                        $filePath = public_path('/upload/admin/cmsfiles/consumer_products/' . $list->txtuplode);
                        // dd($filePath);
                
                        if (file_exists($filePath)) {
                            $sizeInKB = round(filesize($filePath) / 1024, 2);
                            $list->file_size = round($sizeInKB / 1024, 2) > 1 ?  round($sizeInKB / 1024, 2) . " MB" : $sizeInKB . " KB";

                            $mimeType = mime_content_type($filePath);
                            $list->is_pdf = ($mimeType === 'application/pdf') ? true : false;
                        } else {
                            $list->file_size = "File not found! ";
                        }
                    }
                }

                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/consumerAssociation", compact( 'data','consumer_associations','title','id','m_flag_id','m_url','chtitle'));
            }

            $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
            return response()->view("themes/{$themes}/innerpages", compact( 'data','title','id','m_flag_id','m_url','chtitle'));
        }else{
           
            return redirect('/');  
        }
      
    }
    
    public function tenderivew($slug="")
    {   
        $langid=session()->get('locale')??1;
       
      
        $data =  Tender::where('url', 'LIKE', "%{$slug}%")->where('txtstatus',3)->where('language', $langid)->select('tender_title','language','description','url','txtuplode','txtweblink','start_date','end_date')->first();
        $title=''; $id='';$m_flag_id=''; $m_url='';$chtitle='';
        if(!empty($data)){
            $title=$data->officers_name;
            $m_url=$data->url;
            $id=$data->id;
            $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        
            return response()->view("themes/{$themes}/innerpages", compact( 'data','title','id','m_url','chtitle'));
        
        }else{
           
            return redirect('/');  
        }
      
    }
    public function officers($slug="")
    {   
        $langid=session()->get('locale')??1;
       
      
        $data =  Officer::where('url', 'LIKE', "%{$slug}%")->where('txtstatus',3)->where('language', $langid)->select('officers_name','url','designation','contents','language','txtuplode','txtstatus','admin_id')->first(); 
        $title=''; $id='';$m_flag_id=''; $m_url='';$chtitle='';
        if(!empty($data)){
            $title=$data->officers_name;
            $m_url=$data->url;
            $id=$data->id;
            $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        
            return response()->view("themes/{$themes}/officers", compact( 'data','title','id','chtitle'));
        
        }else{
           
            return redirect('/');  
        }
      
    }
}
