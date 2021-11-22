<?php

namespace App\Http\Controllers\Admin;

use App\Model\FestivalVideoUpload;
use App\Model\Video;
use App\Model\VideoUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;


class FestivalVideoUploadController extends Controller
{
    //
    private $data = array(
        'route' => 'admin.festival_video_upload.',
        'title' => 'Festival Video Upload',
        'menu' => 'festival',
        'submenu' => 'festival_video_upload',
    );
    public function __construct() {
        // $this->middleware('auth');
        //$this->middleware(['permission:publish |category add|category edit|category delete']);
    }
    private function _validate($request, $id = null) {
        $this->validate($request, [
            'title' => 'required|max:255',
            'festival_id' => 'required',
            'video'=> 'required',
            'description'=>'required',
            'language'=>'required',
        ]);
    }

    public function index(Request $request) {
//        if($request->has('export') && ($request->get('export')=='xlsx' || $request->get('export')=='csv')){
//            $categories = ImageUpload::select(['category_id','status','created_at','updated_at'])->orderBy('id','ASC')->get()->toArray()->with('category');
//            $this->exportFile($request->get('export'), 'image_upload', ['Title', 'Status', 'Created At', 'Updated At'], $categories);
//        }

        if ($request->ajax()) {
            $records = FestivalVideoUpload::select('*')->with('videocategory')->orderBy('id','ASC');

            return DataTables::of($records)
                ->editColumn('sequence', function ($record) {
                    return '<input style="width:100px" type="text" class="form-control txt_inline_edit inline_update" name="" value="'.$record['sequence'].'" row_id="'.$record['id'].'" field="sequence" ajax_url="'. route($this->data['route'] . 'update',$record['id']).'" />';
                })
                ->editColumn('title', function ($record) {
                    return $record->title;
                })
                ->editColumn('video', function ($record) {
                    return '<video width="200"  controls>
                                            <source src="'.$record['video_url'].'" type="video/mp4">
                                            <source src="'.$record['video_url'].'" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>';
                })
                ->addColumn('status', function ($record) {
                    return '<input id="toggle-demo" value="' . $record->id . '" class="chk_status" data-toggle="toggle" data-on=" Active " data-off="Inactive &nbsp;" data-size="small" data-onstyle="success" data-offstyle="info"  type="checkbox" ' . ($record->status == "Active" ? " checked" : "" ) . ' >';
                })
                ->addColumn('action', function ($record) {
                    return '<a href="' . route($this->data['route'] . 'show', ['id' => $record->id]) . '" class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye-slash"></i></a>' .
                        '&nbsp;<a href="' . route($this->data['route'] . 'edit', ['id' => $record->id]) . '" class="btn btn-info btn-sm" title="" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-edit"></i></a>' .
                        '&nbsp;<button class="btn btn-danger btn-sm data-delete " data-id="' . $record->id . '" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['status', 'action','video','sequence'])
                ->make(true);
        }
        return view('admin.festival_video_upload.index', $this->data);

    }
    public function create() {
        //abort_unless(Auth::guard('admin')->user()->hasAnyPermission(['category add']), 403);
        return view('admin.festival_video_upload.create', $this->data);
    }
    public function store(Request $request) {
        $this->_validate($request);
        $inputs = $request->all();
        $inputs['status'] = 'Active';
        $inputs['video'] = $this->uploadFile($request, null, 'video', 'festival_video');

        $record = new FestivalVideoUpload($inputs);
        $record->save();

        Session::flash('success', $this->data['title'] . ' inserted successfully.');
        return redirect()->route($this->data['route'] . 'index');
    }
    public function show($id) {
        $this->data['record'] = FestivalVideoUpload::findOrFail($id);
        return view('admin.festival_video_upload.show', $this->data);
    }

    public function edit($id) {
        //abort_unless(Auth::guard('admin')->user()->hasAnyPermission(['category edit']), 403);
        $this->data['record'] = FestivalVideoUpload::findOrFail($id);
        return view('admin.festival_video_upload.create', $this->data);
    }

    public function update(Request $request, $id) {
        //abort_unless(Auth::guard('admin')->user()->hasAnyPermission(['category edit']), 403);
        $record = FestivalVideoUpload::findOrFail($id);
        /* Change Status Block */
        if ($request->ajax()) {
            $record->update($request->all());
            return \Illuminate\Support\Facades\Response::json(['result' => 'success']);
        }
      //  $this->_validate($request);

        $inputs = $request->all();
        $inputs['video'] = $this->uploadFile($request, $record, 'video', 'festival_video');
        if (empty($inputs['video'])) {
            unset($inputs['video']);
        }
        $record->update($inputs);

        Session::flash('info', $this->data['title'] . ' updated successfully.');
        return redirect()->route($this->data['route'] . 'index');
    }
    public function destroy($id) {
        //abort_unless(Auth::guard('admin')->user()->hasAnyPermission(['category delete']), 403);
        $record = FestivalVideoUpload::findOrFail($id);
        $this->deleteFile($record,'festival_video');
        $record->delete();
        return \Illuminate\Support\Facades\Response::json([
            'result' => 'success',
            'message' => 'Deleted Data successfully!']);
    }

}
