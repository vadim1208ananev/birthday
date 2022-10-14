<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
   public static function getData()
   {
       $return_data=[];
       $read_scope=\Google_Service_Sheets::SPREADSHEETS;
       $google_creds=storage_path('credentials.json');
       putenv( 'GOOGLE_APPLICATION_CREDENTIALS=' . $google_creds);
       $client = new \Google_Client();
       $client->useApplicationDefaultCredentials();
       $client->addScope( $read_scope );
       $service = new \Google_Service_Sheets($client);
       $doc=$service->spreadsheets_values->get(env('SPREADSHEETID'), config('bot.range'));
       if(isset($doc->values))
       {
	           $return_data=array_filter($doc->values,function($item){
			   return (count($item)==2);
		   });
       }
       return $return_data;
   }
}
