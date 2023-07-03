<?php

namespace App\Http\Controllers;


use App\Models\StudiepuntenExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudiepuntenController extends Controller
{
    public function index()
    {
        $studiepunten = StudiepuntenExcel::where('studentennummer', Auth::user()->id)->first();
        if (empty($studiepunten)) return view('studiepunten.nietGevonden');
        return view('studiepunten.index', ['studiepunten' => json_decode($studiepunten->studiepunten)]);
    }
}
