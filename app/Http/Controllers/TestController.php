<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $insert_scope='https://www.googleapis.com/auth/spreadsheets';
       $read_scope=\Google_Service_Sheets::SPREADSHEETS;

        $google_creds=storage_path('credentials.json');
        putenv( 'GOOGLE_APPLICATION_CREDENTIALS=' . $google_creds);
        $client = new \Google_Client();
        $client->useApplicationDefaultCredentials();

        $client->addScope( $read_scope );

        $service = new \Google_Service_Sheets($client);
        $spreadsheetId = '1IDBAp_r1cNbiCiK0WohkX2sczTHPFkHz4KjTj0Yu_Yc';
        $sheetName = 'Sheet11';
        $range = $sheetName;
        $doc=$service->spreadsheets_values->get($spreadsheetId, $range);
        return response()->json($doc);
       // print_r($doc);

        //clear all data
     /*   $range = $sheetName;  // TODO: Update placeholder value.
        $requestBody = new \Google_Service_Sheets_ClearValuesRequest();
        $service->spreadsheets_values->clear($spreadsheetId, $range, $requestBody);

        // insert data
        $valueRange = new \Google_Service_Sheets_ValueRange();
   $values=[[4,8,5]];
        $body = new \Google_Service_Sheets_ValueRange( [ 'values' => $values] );

        // valueInputOption - определяет способ интерпретации входных данных
        // https://developers.google.com/sheets/api/reference/rest/v4/ValueInputOption
        // RAW | USER_ENTERED
        $options = array( 'valueInputOption' => 'RAW' );
       $service->spreadsheets_values->update( $spreadsheetId, $sheetName . '!A1', $body, $options );*/
    }
    //
}
