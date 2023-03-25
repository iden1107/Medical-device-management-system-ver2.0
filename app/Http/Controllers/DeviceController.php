<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Device;
use App\Models\Manufacturer;
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
    public function showDeviceDetail($id)
    {
        return Inertia::render('DeviceDetail',[
            'device' =>  DB::table('devices')
                            ->select('devices.id as device_id', 'devices.name as device_name', 'inspection_date','status' ,'location_id', 'locations.name as location_name','manufacturer_id','manufacturers.name as manufacturer_name')
                            ->leftJoin('manufacturers', 'devices.manufacturer_id', '=', 'manufacturers.id')
                            ->leftJoin('locations', 'devices.location_id','=','locations.id')
                            ->where('devices.id', $id)
                            ->first(),
            'manufacturers' => Manufacturer::all()
        ]);
    }
}
