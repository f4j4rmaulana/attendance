<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //
    public function pageAttendance()
    {
        return view('pages.attendance');
    }

    public function storeAttendance()
    {
        return 'Hey';
    }
}

