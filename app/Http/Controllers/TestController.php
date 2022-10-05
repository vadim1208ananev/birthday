<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $google_creds=storage_path('credentials.json');
        putenv( 'GOOGLE_APPLICATION_CREDENTIALS=' . $google_creds);
        $client = new \Google_Client();
        $client->useApplicationDefaultCredentials();


//dd(is_file(storage_path('credentials.json')));
        // Области, к которым будет доступ
        // https://developers.google.com/identity/protocols/googlescopes
        $client->addScope( 'https://www.googleapis.com/auth/spreadsheets' );

        $service = new \Google_Service_Sheets($client);
        $spreadsheetId = '1IDBAp_r1cNbiCiK0WohkX2sczTHPFkHz4KjTj0Yu_Yc';
        $sheetName = 'Sheet1';

        //clear all data
        $range = $sheetName;  // TODO: Update placeholder value.
        $requestBody = new \Google_Service_Sheets_ClearValuesRequest();
        $service->spreadsheets_values->clear($spreadsheetId, $range, $requestBody);

        // insert data
        $valueRange = new \Google_Service_Sheets_ValueRange();
    }
    //
}
