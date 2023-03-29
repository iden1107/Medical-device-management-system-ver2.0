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
            'devices' => Device::all()->groupBy('location_id')
        ]);
    }
    public function showDeviceDetail(Device $device)
    {
        return Inertia::render('DeviceDetail',[
            'device' =>  DB::table('devices')
                            ->select('devices.id as device_id', 'devices.name as device_name', 'inspection_date','status' ,'location_id', 'locations.name as location_name','manufacturer_id','manufacturers.name as manufacturer_name')
                            ->leftJoin('manufacturers', 'devices.manufacturer_id', '=', 'manufacturers.id')
                            ->leftJoin('locations', 'devices.location_id','=','locations.id')
                            ->where('devices.id', $device->id)
                            ->first(),
            'manufacturers' => Manufacturer::all()
        ]);
    }
    public function updateDevice(Request $request,Device $device)
    {
        // ルートモデルバインディングでupdateする方法
        // $device->name = $request->device_name;
        // $device->inspection_date = $request->inspection_date;
        // $device->status = $request->status;
        // $device->location_id = $request->location_id;
        // $device->manufacturer_id = $request->manufacturer_id;
        // $device->save();

        Device::where('id', $device->id)->update([
            'name' => $request->device_name,
            'inspection_date' => $request->inspection_date,
            'status' => $request->status,
            'location_id' => $request->location_id,
            'manufacturer_id' => $request->manufacturer_id,
        ]);

        return redirect()->route("deviceList");
    }
    public function showDeviceCreate(Request $request,Device $device)
    {
        return Inertia::render('DeviceCreate', [
            'device' =>  DB::table('devices')
            ->select('devices.id as device_id', 'devices.name as device_name', 'inspection_date', 'status', 'location_id', 'locations.name as location_name', 'manufacturer_id', 'manufacturers.name as manufacturer_name')
            ->leftJoin('manufacturers', 'devices.manufacturer_id', '=', 'manufacturers.id')
            ->leftJoin('locations', 'devices.location_id', '=', 'locations.id')
            ->where('devices.id', $device->id)
                ->first(),
            'manufacturers' => Manufacturer::all()
        ]);
    }
    public function updateLocation(Request $request)
    {
        $data =  $request->all();
        foreach($data as $locationID => $val){
            foreach($val as $deviceID){
                Device::where('id', $deviceID)->update([
                    'location_id' => $locationID
                ]);
            };
        };
    }
    public function showDeviceList()
    {
        return Inertia::render('DeviceList', [
            'devices' =>  DB::table('devices')
                ->select('devices.id as device_id', 'devices.name as device_name', 'inspection_date', 'status', 'location_id', 'locations.name as location_name', 'manufacturer_id', 'manufacturers.name as manufacturer_name')
                ->leftJoin('manufacturers', 'devices.manufacturer_id', '=', 'manufacturers.id')
                ->leftJoin('locations', 'devices.location_id', '=', 'locations.id')
                ->orderBy('device_id','asc')
                ->get()
        ]);
    }
}
