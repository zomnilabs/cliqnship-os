<?php
namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }
}