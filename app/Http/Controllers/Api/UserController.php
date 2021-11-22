<?php

namespace App\Http\Controllers\Api;

use App\Model\Business;
use App\Model\Company;
use App\Model\ImageUpload;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function register(Request $request)
    {
//        return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'contact' => 'required|unique:users,contact',
        ]);
        if ($validator->fails()) {
            $response['result'] = '0';
            $response['message'] = $errors = $validator->errors()->first();
            $response['errors'] = $errors = $validator->errors();
        } else {
            $random = Str::random(100);
            $user = \App\User::create([
                'api_token' => $random,
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'image' => $this->uploadFile($request, null, 'image', 'user'),
                'city' => $request['city'],
                'business' => $request['business'],
                'contact' => $request['contact'],
                'status'=> 'Active',

            ]);
            $status_code = 200;
            $response['result'] = '1';
            $response['message'] = 'User registered successfully';
            $response['record'] = \App\User::find($user->id);
        }
        return Response::json($response);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $response['result'] = '0';
            $response['message'] = $errors = $validator->errors()->first();
            $response['errors'] = $errors = $validator->errors();
            $status_code = 422;
        } else {
            $status_code = 200;
            $auth = \App\User::where('email', $request['email'])->first();

            if(!empty($auth) && $auth['status']== 'Inactive'){

                $response['result'] = '0';
                $response['message'] = 'User is inactive';

                return Response::json($response);
            }
            if (!empty($auth) && Hash::check($request['password'], $auth['password'])) {

                if ($auth['contact_verify'] == 0) {

                    $this->sms_otp_send($auth, 'sms_otp');

                }

                $random = Str::random(100);
                $auth->update(['api_token' => $random]);
                $response['result'] = '1';
                $response['message'] = 'login successfully';
                $response['api_token'] = $auth->api_token;
                $response['record'] = $auth;
            } else {
                $response['result'] = '0';
                $response['message'] = 'Invalid email or password';
            }
        }
        return Response::json($response);
    }

    public function forget_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact' => 'required',
        ]);
        if ($validator->fails()) {
            $response['result'] = '0';
            $response['message'] = $errors = $validator->errors()->first();
            $response['errors'] = $errors = $validator->errors();
            $status_code = 422;
        } else {
            $status_code = 200;
            $auth = \App\User::where('contact', $request['contact'])->first();
            if(!empty($auth)){
                $this->sms_otp_send($auth, 'reset_otp');
                $response['result'] = '1';
                $response['message'] = 'otp sent successfully';
            }else{
                $response['result'] = '0';
                $response['message'] = 'invalid contact ';
            }

        }
        return Response::json($response);
    }

    public function reset_password(Request $request){

        $validator = Validator::make($request->all(), [
            'contact' => 'required',
        ]);
        if ($validator->fails()) {
            $response['result']='0';
            $response['message']=$errors = $validator->errors()->first();
            $response['errors']=$errors = $validator->errors();
            $status_code = 422;
        }else{
            $status_code = 200;
            $auth = \App\User::where('contact', $request['contact'])->where('reset_otp',$request['reset_otp'])->first();
            if (!empty($auth)) {

                $auth->update(['password' => bcrypt($request['password'])]);
                $response['result'] = '1';
                $response['message'] = 'password changed successfully';
                $response['record'] = $auth;
            } else {
                $response['result'] = '0';
                $response['message'] = 'Invalid contact or reset_otp';
            }


            }
        return Response::json($response);
    }

    public function check_otp(Request $request)
    {
        $input = $request->all();
        $contact = $input['contact'];
        $user = User::where('contact', '=', $contact)->first();

        if (!empty($user) || $user != '') {
            if (!empty($input['sms_otp']) && $user['sms_otp'] == $input['sms_otp']) {

                $random = Str::random(100);
                $contact_verify = 1;
                $user->update(['api_token' => $random, 'contact_verify' => $contact_verify]);
                $response['result'] = '1';
                $response['message'] = 'sms otp match';
                $response['api_token'] = $user->api_token;
                $response['contact_verify'] = 1;
                $response['record'] = $user;

            } else {
                //$user->update(['contact_verify'=>0]);
                $response['result'] = '0';
                $response['contact_verify'] = 0;
                $response['message'] = 'sms otp not match';

                //$this->sms_otp_send($user);

            }
            return Response::json($response);
        }

    }


    public function profile(Request $request)
    {
        $auth = \App\User::where('api_token', $request['api_token'])->first();
        if (!empty($auth)) {
            if (!empty($request['password'])) {
                $request['password'] = bcrypt($request['password']);
            }
            if (!empty($request['email'])) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users,email,' . $auth->id,
                ]);
                if ($validator->fails()) {
                    $response['result'] = '0';
                    $response['message'] = $errors = $validator->errors()->first();
                    $response['errors'] = $errors = $validator->errors();
                    return Response::json($response);
                }
            }
            $inputs = $request->all();
            if (!empty($request['image'])) {
                $inputs['image'] = $this->uploadFile($request, $auth, 'image', 'user');
            } else {
                unset($inputs['image']);
            }
            $auth->update($inputs);
            $auth['company'] = Company::where('user_id', $auth->id)->first();
            $response['result'] = '1';
            $response['message'] = 'Profile updated successfully';
            $response['record'] = $auth;

        } else {
            $response['result'] = '0';
            $response['message'] = 'Error';
        }
        return Response::json($response);
    }

    public function user_list(Request $request)
    {
        $auth = \App\User::where('api_token', $request['api_token'])->first();
        if (!empty($auth)) {
            $query = User::query();
            if (!empty($request['search'])) {
                $query->where('name', 'LIKE', '%' . $request['search'] . '%');
            }
            $users = $query->paginate();

            $response['result'] = '1';
            $response['message'] = 'success';
            $response['records'] = $users;

        } else {
            $response['result'] = '0';
            $response['message'] = 'Error';
        }
        return Response::json($response);
    }

    // add category images
    public function category_images_add(Request $request)
    {

        $auth = \App\User::where('api_token', $request['api_token'])->first();
        if (!empty($auth)) {
            $category = ImageUpload::create([
                'status' => 'Active',
                'image' => $this->uploadFile($request, null, 'image', 'category'),
                'title' => $request['title'],
                'description' => $request['description']

            ]);
            $response['result'] = '1';
            $response['message'] = 'Category Image Added successfully';
            $response['record'] = Category::find($category->id);

        } else {
            $response['result'] = '0';
            $response['message'] = 'Invalid Token';
        }
        return Response::json($response);
    }

    public function sms_otp_send($auth, $field)
    {
        // START SMS

        $sms_code = random_int(111111, 999999);
        // save otp to db
        $auth->$field = $sms_code;
        $auth->save();
        //END SMS

        //http://sms.hspsms.com/sendSMS?username=nkinvest&message=Dear User, Hello from EveparApp, Your Registration OTP is 7852 Regards, Cenko Evepar Pvt Ltd Team&sendername=evepar&smstype=TRANS&numbers=9998366123&apikey=2ecf3464-fd02-4d7e-bb7f-8374b6ba5e94
        //http://sms.hspsms.com/sendSMS?username=nkinvest&message=Your+OTP+for+Cenko+Evepar+is+%3A+831439&sendername=evepar&smstype=TRANS&numbers=9998366123&apikey=2ecf3464-fd02-4d7e-bb7f-8374b6ba5e94
        $url = 'http://sms.hspsms.com/sendSMS';
        $data = array(
            'username' => 'nkinvest',
            //'message' => 'Dear User, Hello from EveparApp, Your Registration OTP is ' . $sms_code . ' Regards, Cenko Evepar Pvt Ltd Team',
            'message' => 'test msg',
            'sendername' => 'evepar',
            'smstype' => 'TRANS',
            'numbers' => $auth['contact'],
            'apikey' => '2ecf3464-fd02-4d7e-bb7f-8374b6ba5e94',
        );

        $query_string = http_build_query($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url . '?' . $query_string); //Url together with parameters
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7); //Timeout after 7 seconds
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $result = curl_exec($ch);
        curl_close($ch);


        // send sms stop
    }

    public function feedback(Request $request)
    {
//        return $request->all();
        $auth = \App\User::where('api_token', $request['api_token'])->first();

        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            $response['result'] = '0';
            $response['message'] = $errors = $validator->errors()->first();
            $response['errors'] = $errors = $validator->errors();
        } else {
            if (!empty($auth)) {
                $feedback = \App\Model\Feedback::create([
                    'user_id' => $auth['id'],
                    'name' => $request['name'],
                    'contact' => $request['contact'],
                    'description' => $request['description'],

                ]);
                $status_code = 200;
                $response['result'] = '1';
                $response['message'] = 'feedback successfully';
                $response['record'] = \App\Model\Feedback::find($feedback->id);

            } else {
                $response['result'] = '0';
                $response['message'] = 'Invalid Token';

            }
        }
        return Response::json($response);
    }

    public function business_list(Request $request)
    {

        $records = Business::select(['id','name'])->where('status','Active')->orderBy('name', 'ASC')->get();
        $response['result'] = '1';
        $response['message'] = 'success';
        $response['records'] = $records;
        return Response::json($response);

    }

}
