<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct() {

    }
    public function settingCreate() {
        return view('backend.setting.setting');
    }
}