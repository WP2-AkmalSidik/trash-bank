<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NasabahController extends Controller
{
    public function index() {
        return view('admin.management-nasabah');
    }
}
