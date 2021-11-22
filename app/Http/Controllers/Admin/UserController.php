<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    private $data = array(
        'route' => 'admin.user.',
        'title' => 'User',
        'menu' => 'user',
        'submenu' => '',
    );
    public function __construct()
    {
        // $this->middleware('auth');
    }
    private function _validate($request, $id = null)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email'.(!empty($id)?','.$id:''),
            'password' => ($id == null)?'required|required_with:password_confirmation|max:255':'required_with:password_confirmation|max:255',
            //'password_confirmation' => 'required_with:password|max:255|same:password',
        ]);
//        if ($id == null) {
//            $this->validate($request, [
//                'password' => 'required|max:255',
//                'password_confirmation' => 'required|max:255|same:password',
//            ]);
//        }
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $records = User::select('*');
            return DataTables::of($records)
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->format(config('setting.DATE_FORMAT'));
                })
                ->editColumn('plan_start', function ($record) {
                    return !empty($record->plan_start)?$record->plan_start:'<button class="btn btn-success add_date" data-id="' . $record->id.'"> Purchase</button>';
                })
                ->addColumn('status', function ($record) {
                    return '<input id="toggle-demo" value="' . $record->id . '" class="chk_status" data-toggle="toggle" data-on="Active" data-off="Inactive" data-size="small" data-onstyle="success" data-offstyle="info"  type="checkbox" ' . ($record->status == "Active" ? " checked" : "" ) . ' >';
                })
                ->addColumn('action', function ($record) {
                    return '<a href="' . route($this->data['route'] . 'show', ['id' => $record->id]) . '" class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye-slash"></i></a>' .
                        '&nbsp;<a href="' . route($this->data['route'] . 'edit', ['id' => $record->id]) . '" class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-edit"></i></a>' .
                        '&nbsp;<button class="btn btn-danger btn-sm data-delete " data-id="' . $record->id . '" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['status', 'action','plan_start'])
                ->make(true);
        }
        return view('admin.user.index',$this->data);
    }

    public function create()
    {
        return view('admin.user.create',$this->data);
    }


    public function store(Request $request)
    {

        $this->_validate($request);
        $request['password'] = bcrypt($request['password']);
        $request['status'] = 'Active';
        $inputs['image'] = $this->uploadFile($request, null, 'image', 'user');

        $record =  new User($request->all());
        $record->save();

        Session::flash('success', $this->data['title'].' inserted successfully.');
        return redirect()->route($this->data['route'].'index');
    }


    public function show($id)
    {
        $this->data['record'] = User::findOrFail($id);
        $this->data['business'] = Company::where('user_id',$id)->get();
        return view('admin.user.show',$this->data);
    }


    public function edit($id)
    {
        $this->data['record'] = User::findOrFail($id);
        return view('admin.user.create',$this->data);
    }


    public function update(Request $request, $id)
    {
        $record = User::findOrFail($id);
        if ($request->ajax() && !empty($request['date'])) {
            $date = Carbon::now()->format('Y-m-d');
            $record->plan_start = $date;
            $record->plan_end = Carbon::now()->addYear()->format('Y-m-d');
            $record->save();
            return \Illuminate\Support\Facades\Response::json([
                'result'=>'success',
                'date'=>$date
            ]);
        }

        /* Change Status Block */

        if ($request->ajax()) {

            $record->update($request->only(['status']));
            return \Illuminate\Support\Facades\Response::json(['result'=>'success']);
        }

        $this->_validate($request,$id);
        $inputs = $request->all();
        $inputs['image'] = $this->uploadFile($request, $record, 'image', 'user');
        if (empty($inputs['image'])) {
            unset($inputs['image']);
        }
        if($inputs['password']){
            $inputs['password'] = bcrypt($inputs['password']);
        }
        if(empty($inputs['password'])){
            unset($inputs['password']);
        }
        $record->update($inputs);

        Session::flash('info', $this->data['title'].' updated successfully.');
        return redirect()->route($this->data['route'].'index');
    }


    public function destroy($id)
    {
        $record = User::findOrFail($id);
        $record->delete();
        return \Illuminate\Support\Facades\Response::json(['result'=>'success','message'=>'Deleted Data successfully!']);
    }

}
