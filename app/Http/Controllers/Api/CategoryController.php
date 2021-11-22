<?php

namespace App\Http\Controllers\Api;

use App\Model\About;
use App\Model\BusinessCategory;
use App\Model\BusinessCategoryImageUpload;
use App\Model\BusinessVideoUpload;
use App\Model\Company;
use App\Model\FestivalVideoUpload;
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
use Validator;


class CategoryController extends Controller
{
    //add Images category data
    public function category_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'language' => 'required',
        ]);
        if ($validator->fails()) {
            $response['result'] = '0';
            $response['message'] = $errors = $validator->errors()->first();
            $response['errors'] = $errors = $validator->errors();
        } else {
            $auth = \App\User::where('api_token', $request['api_token'])->first();
            if (!empty($auth)) {
                $category = Category::create([
                    'status' => 'Active',
                    'image' => $this->uploadFile($request, null, 'image', 'category'),
                    'name' => $request['name'],
                    'language' => $request['language']

                ]);
                $response['result'] = '1';
                $response['message'] = 'Category Added successfully';
                $response['record'] = Category::find($category->id);

            } else {
                $response['result'] = '0';
                $response['message'] = 'Invalid Token';
            }
        }
        return Response::json($response);
    }


    // list all category
    public function category_list(Request $request)
    {

        //$auth = \App\User::where('api_token',$request['api_token'])->first();
        //  if(!empty($auth)){


        $query = Category::query();
//        if (!empty($request['language'])) {
//            $query->where('language', $request['language']);
//        }
        $query->where("status", "Active");
        // $query->where("active_from", "<=",Carbon::now()->format('Y-m-d'));

        $query->orderBy('id', 'DESC');

        $records = $query->paginate();

        foreach ($records as $key => $record) {
            $today = Carbon::now();

            if (!empty($record['active_from']) && ($today->format('Y-m-d') < Carbon::parse($record['active_from'])->format('Y-m-d'))) {

                $records[$key]['detail_display'] = 'No';
                $records[$key]['detail_message'] = 'This festival available after ' . Carbon::parse($record['active_from'])->format('d-m-Y');

            } else {
                $records[$key]['detail_display'] = 'Yes';
                $records[$key]['detail_message'] = '';

            }

        }
        $response['result'] = '1';
        $response['message'] = 'success';
        $response['records'] = $records;

//        }else{
//            $response['result'] = '0';
//            $response['message'] = 'Invalid Token';
//        }
        return Response::json($response);
    }

    // delete category
    public function category_delete(Request $request)
    {

        $auth = \App\User::where('api_token', $request['api_token'])->first();
        if (!empty($auth)) {
            $record = Category::findOrFail($request['id']);
            $this->deleteFile($record, 'image', pathinfo('category'));
            $record->delete();
            $response['result'] = '1';
            $response['message'] = 'Delete Category successfully';

        } else {
            $response['result'] = '0';
            $response['message'] = 'Invalid Token';
        }
        return Response::json($response);
    }

    //category images upload
    public function category_images_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            $response['result'] = '0';
            $response['message'] = $errors = $validator->errors()->first();
            $response['errors'] = $errors = $validator->errors();
        } else {
            $auth = \App\User::where('api_token', $request['api_token'])->first();
            if (!empty($auth)) {
                $category_image = ImageUpload::create([
                    'status' => 'Active',
                    'image' => $this->uploadFile($request, null, 'image', 'category_image'),
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'category_id' => $request['category_id']

                ]);
                $response['result'] = '1';
                $response['message'] = 'Category image Added successfully';
                $response['record'] = ImageUpload::find($category_image->id);

            } else {
                $response['result'] = '0';
                $response['message'] = 'Invalid Token';
            }
        }
        return Response::json($response);
    }

    //category images delete
    public function category_images_delete(Request $request)
    {

        $auth = \App\User::where('api_token', $request['api_token'])->first();
        if (!empty($auth)) {
            $record = ImageUpload::findOrFail($request['id']);
            $this->deleteFile($record, 'image', pathinfo('category'));
            $record->delete();
            $response['result'] = '1';
            $response['message'] = 'Delete Category image successfully';

        } else {
            $response['result'] = '0';
            $response['message'] = 'Invalid Token';
        }
        return Response::json($response);
    }

    //about us description add
    public function about(Request $request)
    {

        $auth = \App\User::where('api_token', $request['api_token'])->first();
        if (!empty($auth)) {
            $record = About::create([
                'description' => $request['description']

            ]);
            $response['result'] = '1';
            $response['message'] = 'About description Added successfully';
            $response['record'] = About::find($record->id);

        } else {
            $response['result'] = '0';
            $response['message'] = 'Invalid Token';
        }
        return Response::json($response);
    }

    // list all category images
    public function category_images_list(Request $request)
    {

//        $auth = \App\User::where('api_token',$request['api_token'])->first();
//        if(!empty($auth)){


        $query = ImageUpload::query();
        if (!empty($request['language']) && $request['language'] == 'Gujarati') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'Hindi') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'English') {
            $query->where('language', $request['language']);
        }

        if (!empty($request['category_id'])) {
            $query->where('category_id', $request['category_id']);
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

    //Company detail add
    public function company_detail_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'email' => 'required',
            'contact' => 'required',
        ]);
        if ($validator->fails()) {
            $response['result'] = '0';
            $response['message'] = $errors = $validator->errors()->first();
            $response['errors'] = $errors = $validator->errors();
        } else {
            $auth = \App\User::where('api_token', $request['api_token'])->first();
            if (!empty($auth)) {
                // check it's user company or not ?
                if (!empty($request['company_id'])) {
                    $company_check = Company::find($request['company_id']);
                    if (!empty($company_check) && $company_check['user_id'] != $auth['id']) {
                        $response['result'] = '0';
                        $response['message'] = 'unauthorized access';
                        return Response::json($response);
                    }
                }

                $company_add = Company::where('user_id', $auth->id)->first();
                if (!empty($company_add) && empty($request['company_id'])) {
                    $response['result'] = '0';
                    $response['message'] = 'Company Already added';
                } else {
                    $company = Company::updateOrCreate(['id' => $request['company_id']], [
                        'name' => $request['name'],
                        'logo' => $this->uploadFile($request, null, 'logo', 'company'),
                        'email' => $request['email'],
                        'address' => $request['address'],
                        'user_id' => $auth['id'],
                        'contact' => $request['contact'],
                        'website' => $request['website']
                    ]);
                    $response['result'] = '1';
                    $response['message'] = 'success';
                    $response['record'] = Company::find($company->id);
                }

//            if(empty($company_add) && empty($company_add['company_id'])){
//
//
//            }else{
//                $response['result'] = '0';
//                $response['message'] = 'Company Already added';
//            }

            } else {
                $response['result'] = '0';
                $response['message'] = 'Invalid Token';
            }
        }
        return Response::json($response);
    }

    // category video upload api

    //category images upload
    public function category_video_add(Request $request)
    {

        $auth = \App\User::where('api_token', $request['api_token'])->first();
        if (!empty($auth)) {
            $category_image = VideoUpload::create([
                'status' => 'Active',
                'video' => $this->uploadFile($request, null, 'video', 'video_category'),
                'title' => $request['title'],
                'description' => $request['description'],
                'video_category_id' => $request['video_category_id']

            ]);
            $response['result'] = '1';
            $response['message'] = 'Category video Added successfully';
            $response['record'] = VideoUpload::find($category_image->id);

        } else {
            $response['result'] = '0';
            $response['message'] = 'Invalid Token';
        }
        return Response::json($response);
    }

    public function category_video_list(Request $request)
    {

//        $auth = \App\User::where('api_token',$request['api_token'])->first();
//        if(!empty($auth)){

        $query = VideoUpload::query();
        if (!empty($request['language']) && $request['language'] == 'Gujarati') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'Hindi') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'English') {
            $query->where('language', $request['language']);
        }

        if (!empty($request['category_id'])) {
            $query->where('category_id', $request['category_id']);
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

    public function video_category_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'language' => 'required',
        ]);
        if ($validator->fails()) {
            $response['result'] = '0';
            $response['message'] = $errors = $validator->errors()->first();
            $response['errors'] = $errors = $validator->errors();
        } else {
            $auth = \App\User::where('api_token', $request['api_token'])->first();
            if (!empty($auth)) {
                $category = VideoCategory::create([
                    'status' => 'Active',
                    'image' => $this->uploadFile($request, null, 'video', 'video_category'),
                    'name' => $request['name'],
                    'language' => $request['language']

                ]);
                $response['result'] = '1';
                $response['message'] = 'VideoCategory Added successfully';
                $response['record'] = VideoCategory::find($category->id);

            } else {
                $response['result'] = '0';
                $response['message'] = 'Invalid Token';
            }
        }
        return Response::json($response);
    }

    public function video_category_list(Request $request)
    {

//        $auth = \App\User::where('api_token',$request['api_token'])->first();
//        if(!empty($auth)){

        $query = VideoCategory::query();
        if (!empty($request['language'])) {
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

    //slider add ,list api

    public function slider_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',

        ]);
        if ($validator->fails()) {
            $response['result'] = '0';
            $response['message'] = $errors = $validator->errors()->first();
            $response['errors'] = $errors = $validator->errors();
        } else {
            $auth = \App\User::where('api_token', $request['api_token'])->first();
            if (!empty($auth)) {
                $records = Slider::create([
                    'status' => 'Active',
                    'image' => $this->uploadFile($request, null, 'slider', 'slider_image'),
                    'name' => $request['name']


                ]);
                $response['result'] = '1';
                $response['message'] = 'Slider Added successfully';
                $response['record'] = Slider::find($records->id);

            } else {
                $response['result'] = '0';
                $response['message'] = 'Invalid Token';
            }
        }
        return Response::json($response);
    }

    public function slider_list(Request $request)
    {

//        $auth = \App\User::where('api_token',$request['api_token'])->first();
//        if(!empty($auth)){

        $query = Slider::query();
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

        $query->where('status' ,'Active');
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


    //Business category
    // list all category
    public function business_category_list(Request $request)
    {

        //$auth = \App\User::where('api_token',$request['api_token'])->first();
        //  if(!empty($auth)){

        $query = BusinessCategory::query();
//        if (!empty($request['language'])) {
//            $query->where('language', $request['language']);
//        }
//
        if (!empty($request['language']) && $request['language'] == 'Gujarati') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'Hindi') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'English') {
            $query->where('language', $request['language']);
        }

        $query->orderBy('name', 'ASC');

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
    public function business_category_images_list(Request $request)
    {

//        $auth = \App\User::where('api_token',$request['api_token'])->first();
//        if(!empty($auth)){


        $query = BusinessCategoryImageUpload::query();
        if (!empty($request['language']) && $request['language'] == 'Gujarati') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'Hindi') {
            $query->where('language', $request['language']);
        }
        if (!empty($request['language']) && $request['language'] == 'English') {
            $query->where('language', $request['language']);
        }

        if (!empty($request['business_category_id'])) {
            $query->where('business_category_id', $request['business_category_id']);
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

    public function festival_video_list(Request $request)
    {

//        $auth = \App\User::where('api_token',$request['api_token'])->first();
//        if(!empty($auth)){

        $query = FestivalVideoUpload::query();
//        if (!empty($request['language']) && $request['language'] != 'All') {
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


        if (!empty($request['festival_id'])) {
            $query->where('festival_id', $request['festival_id']);
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

    public function business_video_list(Request $request)
    {

//        $auth = \App\User::where('api_token',$request['api_token'])->first();
//        if(!empty($auth)){

        $query = BusinessVideoUpload::query();
//        if (!empty($request['language']) && $request['language'] != 'All') {
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


        if (!empty($request['business_id'])) {
            $query->where('business_id', $request['business_id']);
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
