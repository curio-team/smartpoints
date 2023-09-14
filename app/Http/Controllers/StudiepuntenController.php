<?php

namespace App\Http\Controllers;


use App\Models\StudiepuntenExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudiepuntenController extends Controller
{
    public function index()
    {
        $nr = str_replace("i", "", Auth::user()->id);
        $nr = str_replace("D", "", Auth::user()->id);
        $studiepunten = StudiepuntenExcel::where('studentennummer', $nr)->first();
        dd($nr);
        if (empty($studiepunten)) return view('studiepunten.nietGevonden');
        return view('studiepunten.index', ['studiepunten' => json_decode($studiepunten->studiepunten)]);
    }

    public function student(Request $request)
    {
        if($request->user()->type == 'teacher')
        {
            $studiepunten = StudiepuntenExcel::where('studentennummer', $request->nummer)->first();
            if (empty($studiepunten)) return view('studiepunten.nietGevonden');
            return view('studiepunten.index', ['studiepunten' => json_decode($studiepunten->studiepunten), 'nummer' => $request->nummer]);
        }
    }
}
