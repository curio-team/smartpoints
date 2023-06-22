<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Excel;

class StudiepuntenExcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentennummer',
        'klascode',
        'studiepunten'
    ];
}
