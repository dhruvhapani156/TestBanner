<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $storage_folder = '';

    public function uploadFile($request, $record = [], $name, $path, $thumb = false, $thumbWidthSize = null, $thumbHeightSize = null) {
        if($this->storage_folder != null){
            $path = $this->storage_folder.'/'.$path.'/'.Carbon::now()->format('Y').'/'.Carbon::now()->format('m');
        }

        if ($request->hasFile($name)) {
//            return "456";
            $file_name = $request->file($name)->store($path);
            if ($thumb) {
                $file = $request->file($name);
                $path = $file->hashName('thumb/' . $path);
                $image = \Intervention\Image\Facades\Image::make($file);

                // Resize uploaded file
                if ($thumb == true && !empty($thumbWidthSize) && !empty($thumbHeightSize)) {
                    $image->resize($thumbWidthSize, $thumbHeightSize, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } elseif ($thumb == true && !empty($thumbWidthSize) && $thumbHeightSize == null) {
                    $image->resize($thumbWidthSize, null , function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } elseif ($thumb == true && $thumbWidthSize == null && !empty($thumbHeightSize)) {
                    $image->resize(null, $thumbHeightSize, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                Storage::put($path, (string) $image->encode());
                if (!empty($record) && Storage::exists($record[$name]) ) {
                    Storage::delete('thumb/' . $record[$name]);
                }
            }
            if (!empty($record) && Storage::has($record[$name])) {
                Storage::delete($record[$name]);
            }
            return $file_name;
        } else {
            return null;
        }
    }

    public function deleteFile($record,$name,$is_thumb=false){
        if(!empty($record)){
            Storage::delete($record[$name]);
            if($is_thumb){
                Storage::delete('thumb/' . $record[$name]);
            }
        }
    }

    public function exportFile($filetype, $filename = 'export', $headers = [], $records = []) {

        Excel::create($filename, function($excel) use ($headers,$records) {
            $excel->sheet('Sheet1', function($sheet) use ($headers,$records) {
                $sheet->row(1, $headers);
                $sheet->row(1, function($row) {
                    // call cell manipulation methods
                    $row->setBackground('#846648');
                    $row->setFontColor('#FFFFFF');
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setValignment('center');
                });
                // Sheet manipulation
                $sheet->rows($records);
                $sheet->freezeFirstRow();
            });
        })->export($filetype);
    }
}
