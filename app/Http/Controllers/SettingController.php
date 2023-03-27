<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;

class SettingController extends Controller
{
    public function showSetting(){
        return Inertia::render('Setting');
    }

    public function set(Request $request){
        Setting::where('id', $request->id)->update([
            'setting_minutes' => $request->setting_minutes
        ]);
    }
}
