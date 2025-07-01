<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\Menu;
use App\Models\admin\Banner;
use App\Models\admin\Tender;
use App\Models\admin\Videogallerys;
use App\Models\admin\Whatsnew;
use App\Models\admin\Circular;
use App\Models\admin\ConsumerProduct;
use App\Models\admin\Faq;
use App\Models\admin\Logo;
use App\Models\admin\Officer;
use App\Models\admin\Title;
use App\Models\admin\Photogallery;
use App\Models\admin\Podcast;
use App\Models\admin\MinistersInfo;
use App\Models\admin\PressRelease;
use App\Models\admin\Guideline;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug="")
    {   $title="View Menu ";
        $views = Menu::all();
        $view =  Menu::where('m_url', 'LIKE', "%{$slug}%")->first();
		
		$bannerCount = Banner::pending()->count();
        $tenderCount = Tender::pending()->count();
        $videoGalleryCount = Videogallerys::pending()->count();
        $whatsNewCount = Whatsnew::pending()->count();
        $recruitmentCount = Circular::pending()->count();
        $consumerProductCount = ConsumerProduct::pending()->count();
        $faqCount = Faq::pending()->count();
        $logoCount = Logo::pending()->count();
        $officerCount = Officer::pending()->count();
        $titleCount = Title::pending()->count();
        $galleryCount = Photogallery::pending()->count();
        $podcastCount = Podcast::pending()->count();
        $ministersInfoCount = MinistersInfo::pending()->count();
        $pressReleaseCount = PressRelease::pending()->count();
        $guidelineCount = Guideline::pending()->count();
        
        $totalPending = $bannerCount + $tenderCount + $videoGalleryCount + $whatsNewCount + $recruitmentCount + $consumerProductCount + $faqCount + $logoCount + $officerCount + $titleCount + $galleryCount + $podcastCount + $ministersInfoCount + $pressReleaseCount + $guidelineCount;
       
		
        if(!empty($view)){
            return response()->view('/admin/dashboard', compact('views', 'view','title','totalPending'));
        }else{
            return redirect('/');  
        }
      
    }
}
