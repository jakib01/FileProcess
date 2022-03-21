<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// use Maatwebsite\Excel\Facades\Excel;
// use Illuminate\Support\Facades\Input;
//use Excel;


class ProcessController extends Controller
{

    public function index()
    {

        $file = public_path("file/file.xlsx");
        if(file_exists($file)){
            $theArray = Excel::toArray([], $file);
//            return response()->json($theArray);
//                $data1 = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data[1][1]);
//                echo '<pre>' ,var_dump($datas[$start]), '<pre>';

            array_shift($theArray[0]);

            foreach($theArray as $key => $datas){
                foreach($datas as $key1 => $data){
                    foreach ($data as $key2 => $final){
                        if($key2 == 1){
                            $child_array[] = \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeFromTimestamp($final);
                        }
                        elseif($key2 == 6){
                            $child_array[] = \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeFromTimestamp($final);
                        }
                        elseif($key2 == 7){
                            $child_array[] = \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeFromTimestamp($final);
                        }
                        else{
                            $child_array[] = $final;
                        }
                    }
                    $newArray[$key1] = $child_array;
                }
            }

//            foreach ($theArray as $key => $datas){
//                foreach ($datas as $key2 => $data){
//                    $newArray[$key][] = $data;
//                }
//            }
            return response()->json($newArray);
        }
        else echo ('error: Please Check your file, Something is wrong there.');
    }

}
