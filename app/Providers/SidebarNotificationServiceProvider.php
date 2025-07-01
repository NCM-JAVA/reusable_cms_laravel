<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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

class SidebarNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $pendingCounts = [
                'tender'  => Tender::pending()->count(),
                'banner'   => Banner::pending()->count(),
                'videogallery'   => Videogallerys::pending()->count(),
                'whatsnews'   => Whatsnew::pending()->count(),
                'recruitment'   => Circular::pending()->count(),
                'consumer-products'   => ConsumerProduct::pending()->count(),
                'faq'   => Faq::pending()->count(),
                'logo'   => Logo::pending()->count(),
                'officers'   => Officer::pending()->count(),
                'title'   => Title::pending()->count(),
                'gallery'   => Photogallery::pending()->count(),
                'podcast'   => Podcast::pending()->count(),
                'ministers-info'   => MinistersInfo::pending()->count(),
                'press-release'   => PressRelease::pending()->count(),
                'guidelines'   => Guideline::pending()->count(),
            ];

            $view->with('pendingCounts', $pendingCounts);
        });
    }


}
