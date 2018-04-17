<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

class MyController extends Controller
{
    public function setCookie(){
        // echo 'acsdc';
        // die;

    	$response = new Response();
    	/*Xét reponse*/
    	$response->withCookie(
    		'Phuong', /*tên Cookie*/
    		'Hoc IT', /*giá trị*/
    		0.1      /*minutes thời gian*/
    	);
    }
    public function getCookie(Request $request){

    	return $request->cookie('KhoaHoc');
    }
    public function postFile(Request $request){

    

        /*Kiem tra file upload len co ton tai*/
        if($request->hasFile('myFile')){
            /* Luu file */
            /* luu file vua upload len vaof bien file*/
            $file = $request->file('myFile');

            if($file->getClientOriginalExtension('myFile') == "JPG"){


            $filename= $file->getClientOriginalName('myFile');
            
            /* Luu file lai tai thu muc*/

            $file->move('image',$filename);
            echo 'Đã lưu file'.$filename;
             }
             else{
                echo "Không được phép upload";
             }
        }else{
            echo ' Chưa có file';
        }
    }

    public function getJson(){

        $array = ['KhoaHoc'=>'Laravel'];
        return response()->json($array);
        /*Lay du lieu tren app di dong*/
    }
    /* lay tham so t tu route*/
    public function Time($t){
        /* 't'->tham so truyen sang*/

        return view('demo.myview',['t'=>$t]);
    }
    public function blade($str){
        if ($str=='myview') {
            return view('demo.myview');
        }else
        return view('demo.uploadfile');
    }
    public function abc(){
        return view('demo.ex2');
    }
}
