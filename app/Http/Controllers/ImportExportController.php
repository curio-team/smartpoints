<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\ExcelSheet;
use App\Imports\ImportStudiepunten;
use App\Imports\Studiepunten;
use App\Models\StudiepuntenExcel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ImportExportController extends Controller
{

    public function upload(Request $request)
    {
        if(!$request->hasFile('fileName')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        Excel::import(new Studiepunten(), $request->file('fileName'));

    }
}
