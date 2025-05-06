<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NasabahController extends Controller
{
    public function index() {
        return view('admin.management-nasabah');
    }
}
