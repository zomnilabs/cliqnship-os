<?php
namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;

class CMSController extends Controller
{
    public function index()
    {
        return view('admin.cms.index');
    }
}