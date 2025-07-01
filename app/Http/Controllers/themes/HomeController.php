<?php

namespace App\Http\Controllers\themes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Banner;
use App\Models\admin\Photogallery;
use App\Models\admin\Videogallerys;
use App\Models\admin\Officer;
use App\Models\admin\Feedback;
use App\Models\admin\Whatsnew;
use App\Models\admin\Circular;
use App\Models\admin\Menu;
use App\Models\admin\Logo;
use App\Models\admin\Podcast;
use App\Models\admin\SuccessStory;
use Illuminate\Support\Facades\DB;
//use Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    public function index()
    {
        // phpinfo();
        $title = 'Home';

        if(!session()->has('visited')){
            session()->put('visited', true);
            session()->put('locale', 2);
        }
       
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        $banner =  Banner::where('txtstatus',3)->where('txttype',1)->where('language',$langid)->orderBy('updated_at', 'DESC')->paginate(10);
        $poster =  Banner::where('txtstatus',3)->where('txttype',2)->where('language',$langid)->orderBy('updated_at', 'DESC')->limit(10)->get();
        $photogallery = Photogallery::where('txtstatus',3)->where('display_on_home',1)->where('language',$langid)->orderBy('eventdate','DESC')->select('id','title','language','txtuplode','txtstatus','admin_id')->limit(20)->get();
        // dd($photogallery);
        // $photogallerysec = Photogallery::where('txtstatus',3)->where('language',$langid)->orderBy('created_at','DESC')->select('id','title','language','txtuplode','txtstatus','admin_id')->offset(3)->limit(2)->get();
        
        $videoGallery = Videogallerys::where('language', $langid)->orderBy('created_at','DESC')->limit(10)->get();
        if(!empty($videoGallery)){
            foreach($videoGallery as $video_id){
                $videoUrl = $video_id->txtuplode;
                parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);
                $video_id->video_id = $query['v'] ?? null;
            }
        }
		
		$jagrati =  SuccessStory::where('txtstatus',3)->where('storytype',1)->where('language',$langid)->orderBy('updated_at', 'DESC')->paginate(10);
        $ejagrati =  SuccessStory::where('txtstatus',3)->where('storytype',2)->where('language',$langid)->orderBy('updated_at', 'DESC')->paginate(10);

        $officer = Officer::where('txtstatus',3)->where('designation','MD')->where('language',$langid)->select('id','officers_name','url','designation','contents','language','txtuplode','txtstatus')->first();
        $ministers = Officer::where('txtstatus',3)->where('designation','!=','MD')->where('language',$langid)->orderBy('created_at','DESC')->select('id','officers_name','url','designation','contents','language','txtuplode','txtstatus')->limit(3)->get();
        $logos = Logo::where('txtstatus',3)->where('language', $langid)->where('txttype', 1)->orderBy('id', 'DESC')->get();
        $importantLink = Logo::where('txtstatus',3)->where('txttype',2)->where('language', $langid)->orderBy('id', 'DESC')->limit(4)->get();
        $podcasts = Podcast::where('txtstatus',3)->where('language', $langid)->orderBy('id', 'DESC')->limit(5)->get();
        $todate=date('Y-m-d');
        $today= date("Y-m-d", strtotime($todate));
        $whatsnew = Whatsnew::where('enddate','>' ,$today)->where('txtstatus',3)->where('language',$langid)->select('id','title','url','page_url','is_new','language','menutype','metakeyword','metadescription','description','txtuplode','txtweblink','txtstatus','startdate','enddate','created_at')->orderBy('startdate','DESC')->paginate(10);
        $announcement = Circular::where('enddate','>' ,$today)->where('txtstatus',3)->where('language',$langid)->select('id','title','url','page_url','is_new','language','menutype','metakeyword','metadescription','description','txtuplode','txtweblink','txtstatus','startdate','enddate')->paginate(5);
        $mf=0;
        if($langid==1){
        $mf=164;
       }if($langid==2){
        $mf=170;
       }
        $important	 = Menu::where('m_flag_id' ,$mf)->where('approve_status',3)->where('language_id',$langid)->orderBy('page_postion', 'ASC')->select('id','m_id','m_type','m_flag_id','menu_positions','language_id','m_name','m_url','m_title','m_keyword','m_description','content','doc_uplode','linkstatus','approve_status','page_postion','welcomedescription')->paginate(5);
      
        return redirect()->route('login');
        // return response()->view("themes/{$themes}/home", compact( 'jagrati', 'ejagrati', 'banner', 'poster','photogallery', 'videoGallery','officer', 'ministers', 'logos', 'importantLink', 'podcasts', 'whatsnew','announcement','title','important'));
    }
    public function feedback()
    {
        $title = 'Feedback';
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        // echo $themes;
        // die();
        return response()->view("themes/{$themes}/feedback", compact('title'));
    }

    public function feed_process(Request $request)
    {
        // Assuming $langid is either set through session or request
        $langid = session()->get('locale') ?? 1;

        if ($langid == 1) {
            // Default rules for English
            $rules = array(
                'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                'email' => 'required|email',
                'phone' => 'required|regex:/^(\+?[0-9]{1,3})?[0-9]{10}$/',
                'comments' => 'required|max:255|regex:/^[a-zA-Z0-9\s]+$/',
                'CaptchaCode' => 'required'
            );
            $messages = [
                'name.regex' => 'The name field should not contain special characters.',
                'comments.regex' => 'The comments field should not contain special characters.',
            ]; // No custom messages for English
        } else {
            // Rules for other languages (e.g., Hindi)
            $rules = array(
                'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                'email' => 'required|email',
                'phone' => 'required|regex:/^(\+?[0-9]{1,3})?[0-9]{10}$/',
                'comments' => 'required|max:255|regex:/^[a-zA-Z0-9\s]+$/',
                'CaptchaCode' => 'required'
            );

            // Custom error messages in Hindi
            $messages = [
                'name.required' => 'नाम आवश्यक है',
                'name.regex' => 'नाम फ़ील्ड में विशेष वर्ण नहीं होने चाहिए',
                'email.required' => 'ईमेल आवश्यक है',
                'email.email' => 'कृपया एक वैध ईमेल पता प्रदान करें',
                'phone.required' => 'फ़ोन नंबर आवश्यक है',
                'comments.required' => 'टिप्पणियाँ आवश्यक हैं',
                'comments.regex' => 'टिप्पणी फ़ील्ड में विशेष वर्ण नहीं होने चाहिए',
                'comments.max' => 'टिप्पणियाँ 255 वर्णों से अधिक नहीं हो सकती',
                'CaptchaCode.required' => 'कृपया कैप्चा कोड प्रदान करें',
            ];
        }

        // Perform validation with the appropriate language messages
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // Captcha validation
            $code = clean_single_input($request->CaptchaCode); 
            $isHuman = captcha_validate($code);

            if ($isHuman) {
                // Store feedback data
                $pArray['name'] = clean_single_input($request->name); 
                $pArray['email'] = clean_single_input($request->email);
                $pArray['phone'] = clean_single_input($request->phone);
                $pArray['comments'] = clean_single_input($request->comments);
                
                // Create feedback record
                $create = Feedback::create($pArray);
                if ($create) {
                    // Send email (if needed)
                    $name = $request->name;
                    $email = $request->email;
                    $phone = $request->phone;
                    $comments = $request->comments;

                    // Uncomment and configure email logic as needed
                    /*
                    \Mail::send('emails.visitor_email', ['name' => $name, 'email' => $email, 'phone' => $phone, 'comments' => $comments], function ($message) {
                        $message->to("honeylucky2000@gmail.com")->subject('Subject of the message!');
                    });
                    */
                }

                return redirect('feedback')->with('success', 'Feedback has been successfully submitted');
            } else {
                return redirect('feedback')->with('error', 'Captcha is wrong');
            }
        }
    }   
    public function screenreader()
    {
        $title = 'Screen Reader Access';
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        // echo $themes;
        // die();
        return response()->view("themes/{$themes}/screenreader", compact('title'));
    }

    Public function search(Request $request)
    {
        $rules = array(
            'search' => 'required'
        );
        $valid =array(
            'search.required'=>'search field  is required'
        );
         $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
      
            return redirect('/')->withErrors($validator)->withInput();
            
        }else{
            $title = 'Search';
            $search = $request->q;
            $langid=session()->get('locale')??1;
            $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';

            if(!empty($search)){
                $results = Menu::where('language_id', $langid)->where('approve_status', 3)->where('m_name', '!=', 'home')->where(function ($query) use ($search) {
                    $query->where('content', 'LIKE', '%' . $search . '%')
                          ->orWhere('m_name', 'LIKE', '%' . $search . '%');
                })->get();
            }
            
            return response()->view("themes/{$themes}/search", compact('title','results'));
        }
    }

    public function sitemap()
    {
        $title = 'Sitemap';
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        // echo $themes;
        // die();
        return response()->view("themes/{$themes}/siteMaps", compact('title'));
    }
	public function visitorcount()
    {
        $title = 'Visitor Count';
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
		
		$visitorsData = DB::table('visitors')->where('language',$langid)->get();
		$visitorsCountHindi = DB::table('visitors')->where('language', 2)->sum('visitors_count');
		$visitorsCountEnglish = DB::table('visitors')->where('language', 1)->sum('visitors_count');
        // echo $themes;
        // die();
        return response()->view("themes/{$themes}/visitorcount", compact('title','visitorsData','visitorsCountHindi','visitorsCountEnglish'));
    }
    
}
