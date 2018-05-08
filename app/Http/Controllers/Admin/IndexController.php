<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Reports;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index', ['reports' => new Reports()]);
    }
}
