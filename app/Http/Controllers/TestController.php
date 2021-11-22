<?php

namespace App\Http\Controllers;

use App\Model\Test;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class TestController extends Controller
{
    public function index(Request $request){

        Excel::load('file.xlsx', function($reader) {

            // Getting all results
            $results = $reader->get();
            foreach ($results as $result) {
                $data = $result->toArray();

                Test::create([
                    'author'=> $data['author'],
                    'title'=> $data['title'],
                    'type'=> $data['type'],
                    'publisher'=> $data['publisher'],
                    'version'=> $data['version'],
                    'year'=> $data['year'],
                    'remarks'=> $data['remarks'],
                ]);

            }

            // ->all() is a wrapper for ->get() and will work the same
            $results = $reader->all();

        });
        return "123";
    }
}
