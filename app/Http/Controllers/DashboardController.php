<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Catchment;
use DB;
use Log;

class DashboardController extends Controller
{
    public function home()
    {
        if(auth()->user()->user_type == 'Admin'){
            $zones = Zone::all();
            return view('dashboard', compact('zones'));
        }else
            $zone = auth()->user()->zone;

        return view('dashboard', compact('zone'));
    }

    public function addZone(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            Zone::create($request->all());
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }

        return redirect()->back();
    }

    public function editZone(Request $request, Zone $zone)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $zone->update(['name' => $request->name]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }

        return redirect()->back();
    }

    public function viewZone(Zone $zone)
    {
        return view('zone-details', compact('zone'));
    }

    public function addCatchment(Request $request, Zone $zone)
    {
        $this->validate($request, [
            'location' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            Catchment::create([
                'location' => $request->location,
                'zone_id' => $zone->id,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }

        return redirect()->back();
    }

    public function editCatchment(Request $request)
    {
        $this->validate($request, [
            'catchment_id' => 'required|numeric',
            'location' => 'required|string',
        ]);
        
        DB::beginTransaction();
        try {
            Catchment::find($request->catchment_id)->update([
                'location' => $request->location
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }

        return redirect()->back();
    }

    public function deleteCatchment(Catchment $catchment)
    {
        DB::beginTransaction();
        try {
            $catchment->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
        }

        return back();
    }
}
