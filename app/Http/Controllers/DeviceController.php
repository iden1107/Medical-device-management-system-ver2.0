<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Device;
use App\Models\Location;
use Symfony\Component\ErrorHandler\Debug;

class DeviceController extends Controller
{
    public function showFloormap()
    {
        return Inertia::render('Floormap',[
            'devices' => Device::all()->groupBy('location_id')
        ]);
    }
    public function showInventory()
    {
        return Inertia::render('Inventory',[
            'devices' => Device::all()->groupBy('location_id'),
        ]);
    }
    // 詳細画面を作る！！！
    public function showDeviceDetail($id)
    {
        return Inertia::render('DeviceDetail',[
            'device' => Device::where('id',$id)->first()
        ]);
    }
}
