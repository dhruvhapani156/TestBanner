<?php

namespace App\Http\Controllers\Admin;

use App\Model\Feedback;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class FeedbackController extends Controller
{
    private $data = array(
        'route' => 'admin.feedback.',
        'title' => 'Feedback',
        'menu' => 'feedback',
        'submenu' => '',
    );
    public function __construct()
    {
        // $this->middleware('auth');
    }
    private function _validate($request, $id = null)
    {

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
            $records = Feedback::select('*');
            return DataTables::of($records)
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->format(config('setting.DATE_FORMAT'));
                })
                ->addColumn('status', function ($record) {
                    return '<input id="toggle-demo" value="' . $record->id . '" class="chk_status" data-toggle="toggle" data-on=" Active " data-off="Inactive &nbsp;" data-size="small" data-onstyle="success" data-offstyle="info"  type="checkbox" ' . ($record->status == "Active" ? " checked" : "" ) . ' >';
                })
                ->addColumn('action', function ($record) {
                    return '<a href="' . route($this->data['route'] . 'show', ['id' => $record->id]) . '" class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye-slash"></i></a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.feedback.index',$this->data);
    }

    public function create()
    {
        return view('admin.feedback.create',$this->data);
    }


    public function show($id)
    {
        $this->data['record'] = Feedback::findOrFail($id);
        return view('admin.feedback.show',$this->data);
    }


}
