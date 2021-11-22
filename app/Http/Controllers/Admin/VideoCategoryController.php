<?php

namespace App\Http\Controllers\Admin;

use App\Model\Video;
use App\Model\VideoCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class VideoCategoryController extends Controller
{
    private $data = array(
        'route' => 'admin.video_category.',
        'title' => 'VideoCategory',
        'menu' => 'video_category',
        'submenu' => '',
    );

    public function __construct() {
        // $this->middleware('auth');
        //$this->middleware(['permission:publish |category add|category edit|category delete']);
    }

    private function _validate($request, $id = null) {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
    }

    public function index(Request $request) {
        if($request->has('export') && ($request->get('export')=='xlsx' || $request->get('export')=='csv')){
            $video_categories = VideoCategory::select(['name','status','created_at','updated_at'])->orderBy('name','ASC')->get()->toArray();
            $this->exportFile($request->get('export'), 'video_category', ['Name', 'Status', 'Created At', 'Updated At'], $video_categories);
        }

        if ($request->ajax()) {
            $records = VideoCategory::select('*')->orderBy('id','ASC');

            return DataTables::of($records)
                ->editColumn('sequence', function ($record) {
                    return '<input style="width:100px" type="text" class="form-control txt_inline_edit inline_update" name="" value="'.$record['sequence'].'" row_id="'.$record['id'].'" field="sequence" ajax_url="'. route($this->data['route'] . 'update',$record['id']).'" />';
                })
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->format(config('setting.DATE_FORMAT'));
                })
                ->editColumn('image', function ($record) {
                    return '<a target="_blank" href="'.$record['image_url'].'"><img src="'.$record['image_url'].'" width="150"></a>';
                })
                ->addColumn('status', function ($record) {
                    return '<input id="toggle-demo" value="' . $record->id . '" class="chk_status" data-toggle="toggle" data-on=" Active " data-off="Inactive &nbsp;" data-size="small" data-onstyle="success" data-offstyle="info"  type="checkbox" ' . ($record->status == "Active" ? " checked" : "" ) . ' >';
                })
                ->addColumn('action', function ($record) {
                    return '<a href="' . route($this->data['route'] . 'show', ['id' => $record->id]) . '" class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye-slash"></i></a>' .
                        '&nbsp;<a href="' . route($this->data['route'] . 'edit', ['id' => $record->id]) . '" class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-edit"></i></a>' .
                        '&nbsp;<button class="btn btn-danger btn-sm data-delete " data-id="' . $record->id . '" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['status', 'action','image','sequence'])
                ->make(true);
        }
        return view('admin.video_category.index', $this->data);

    }

    public function create() {
        //abort_unless(Auth::guard('admin')->user()->hasAnyPermission(['category add']), 403);
        return view('admin.video_category.create', $this->data);
    }

    public function store(Request $request) {
        //abort_unless(Auth::guard('admin')->user()->hasAnyPermission(['category add']), 403);
        $this->_validate($request);
        $inputs = $request->all();
        $inputs['status'] = 'Active';
        $inputs['image'] = $this->uploadFile($request, null, 'image', 'video_category');

        $record = new VideoCategory($inputs);
        $record->save();

        Session::flash('success', $this->data['title'] . ' inserted successfully.');
        return redirect()->route($this->data['route'] . 'index');
    }

    public function show($id) {
        $this->data['record'] = VideoCategory::findOrFail($id);
        return view('admin.video_category.show', $this->data);
    }

    public function edit($id) {
        //abort_unless(Auth::guard('admin')->user()->hasAnyPermission(['category edit']), 403);
        $this->data['record'] = VideoCategory::findOrFail($id);
        return view('admin.video_category.create', $this->data);
    }

    public function update(Request $request, $id) {
        //abort_unless(Auth::guard('admin')->user()->hasAnyPermission(['category edit']), 403);
        $record = VideoCategory::findOrFail($id);
        /* Change Status Block */
        if ($request->ajax()) {
            $record->update($request->all());
            return \Illuminate\Support\Facades\Response::json(['result' => 'success']);
        }
        $this->_validate($request);

        $inputs = $request->all();
        $inputs['image'] = $this->uploadFile($request, $record, 'image', 'video_category');
        if (empty($inputs['image'])) {
            unset($inputs['image']);
        }
        $record->update($inputs);

        Session::flash('info', $this->data['title'] . ' updated successfully.');
        return redirect()->route($this->data['route'] . 'index');
    }

    public function destroy($id) {
        //abort_unless(Auth::guard('admin')->user()->hasAnyPermission(['category delete']), 403);
        $record = VideoCategory::findOrFail($id);
        $this->deleteFile($record,'image');
        $record->delete();
        return \Illuminate\Support\Facades\Response::json([
            'result' => 'success',
            'message' => 'Deleted Data successfully!']);
    }
}
