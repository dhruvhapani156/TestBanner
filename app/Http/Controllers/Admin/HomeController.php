<?php

namespace App\Http\Controllers\Admin;

use App\Model\BusinessCategoryImageUpload;
use App\Model\BusinessVideoUpload;
use App\Model\FestivalVideoUpload;
use App\Model\GreetingImage;
use App\Model\ImageUpload;
use App\Model\VideoUpload;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private $data = array(
        'route' => 'admin.home.',
        'title' => 'Dashboard',
        'menu' => 'home',
        'submenu' => '',
    );

    public function home(){


            $this->data['business_image'] = BusinessCategoryImageUpload::count();
            $this->data['business_video'] = BusinessVideoUpload::count();
            $this->data['festival_image'] = ImageUpload::count();
            $this->data['festival_video'] = FestivalVideoUpload::count();
            $this->data['greeting_image'] = GreetingImage::count();
         //   $this->data['greeting_video'] = ImageUpload::count();
        return view('admin.dashboard', $this->data);



    }
}
