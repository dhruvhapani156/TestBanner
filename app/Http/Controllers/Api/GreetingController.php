<?php

namespace App\Http\Controllers\Api;

use App\Model\About;
use App\Model\BusinessCategory;
use App\Model\BusinessCategoryImageUpload;
use App\Model\BusinessVideoUpload;
use App\Model\Company;
use App\Model\FestivalVideoUpload;
use App\Model\GreetingCategory;
use App\Model\GreetingImage;
use App\Model\ImageUpload;
use App\Model\Slider;
use App\Model\Video;
use App\Model\VideoCategory;
use App\Model\VideoUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Support\Facades\Response;


class GreetingController extends Controller
{


    //Greeting category
    // list all category
    public function greeting_category_list(Request $request)
    {

        //$auth = \App\User::where('api_token',$request['api_token'])->first();
        //  if(!empty($auth)){

        $query = GreetingCategory::query();
//        if (!empty($request['language'])) {
//            $query->where('language', $request['language']);
//        }

        if (!empty($request['language']) && $request['language'] == 'Gujarati') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'Hindi') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'English') {
            $query->where('language', $request['language']);
        }

        $query->orderBy('id', 'DESC');

        $records = $query->paginate();

        $response['result'] = '1';
        $response['message'] = 'success';
        $response['records'] = $records;

//        }else{
//            $response['result'] = '0';
//            $response['message'] = 'Invalid Token';
//        }
        return Response::json($response);
    }

    // list all category images
    public function greeting_images_list(Request $request)
    {

//        $auth = \App\User::where('api_token',$request['api_token'])->first();
//        if(!empty($auth)){


        $query = GreetingImage::query();
        if (!empty($request['language']) && $request['language'] == 'Gujarati') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'Hindi') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'English') {
            $query->where('language', $request['language']);
        }

        if (!empty($request['greeting_id'])) {
            $query->where('greeting_id', $request['greeting_id']);
        }
        $records = $query->paginate();
        $response['result'] = '1';
        $response['message'] = 'success';
        $response['records'] = $records;

//        }else{
//            $response['result'] = '0';
//            $response['message'] = 'Invalid Token';
//        }
        return Response::json($response);
    }



}
