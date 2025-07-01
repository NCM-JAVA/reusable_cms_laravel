<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\admin\Banner;
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

class AdminApprovalController extends Controller
{
    public function approve($type, $id)
    {
        $model = match ($type) {
            'tender' => Tender::class,
            'banner' => Banner::class,
            'videogallery' => Videogallerys::class,
            'whatsnews' => Whatsnew::class,
            'recruitment' => Circular::class,
            'cosnumer-products' => ConsumerProduct::class,
            'faq' => Faq::class,
            'logo' => Logo::class,
            'officers' => Officer::class,
            'title' => Title::class,
            'gallery' => Photogallery::class,
            'podcast' => Podcast::class,
            'ministers-info' => MinistersInfo::class,
            'press-release' => PressRelease::class,
            'guidelines' => Guideline::class,
            default => abort(404)
        };

        $item = $model::findOrFail($id);
        $item->approve();

        return back()->with('success', ucfirst($type) . ' approved.');
    }
}
