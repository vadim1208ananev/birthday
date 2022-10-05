<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;  //

class TestController extends Controller
{
    public function index(){

        $format='Happy Birthday %s';
         $rows = App::make('get_sheet_data');
        if(!$rows->count())
        {
            Log::channel('bot')->info('sheet without rows');
            return;
        };
        $send_data=$rows->map(function($item,$key){
            $dm='none';
            if(preg_match("/([\d]+)-([\d]+)-([\d]+)/",$item[1],$mutch))
            {
                $dm=$mutch[1].'-'.$mutch[2];
            }
            return ['name'=>$item[0],'date'=>$dm];
        })->where('date',date('d-m',time()));
        if(!$send_data->count())
        {
            Log::channel('bot')->info('not one birthday');
            return;
        }
        $send_data->each(function($item,$key) use($format) {

              $message=sprintf($format,$item['name']);
              print_r($message);
        });

        print_r(date('d-m-Y h:i:s',time()));
    }

    //
}
