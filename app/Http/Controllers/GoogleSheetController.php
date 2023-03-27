<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Google\Service\Sheets\Sheet;
Use Revolution\Google\Sheets\Facades\Sheets;


class GoogleSheetController extends Controller
{
    //
    public function index()
    {
        // dd('thai');
        $value = Sheets::spreadsheet('1jgYSL7jophAqS_TJltFHQEMn8-B66ejiJ8q1QOtPAxI')->sheet('Demo')->all();
        dd($value);
    }
}
